<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\EquipmentReplacement;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\JobType;
use App\Models\PartSerialNo;
use App\Models\Technician;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\UserAddress;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter                     = [];
        $filter['customer']         = $request->customer;
        $filter['equipment']        = $request->equipment;
        $filter['address']          = $request->address;
        $filter['technician']       = $request->technician;
        $filter['start_date']       = $request->start_date;
        $filter['end_date']         = $request->end_date;
        $filter['service_type']     = $request->service_type;
        $filter['status']           = $request->status;

        $jobs                       = Job::query();

        $jobs                       = isset($filter['customer']) ? $jobs->where('user_id', $filter['customer']) : $jobs;
        $jobs                       = isset($filter['equipment']) ? $jobs->where('equipment_id', $filter['equipment']) : $jobs;

        $jobs                       = isset($filter['technician']) ? $jobs->where('technician_id', $filter['technician']) : $jobs;
        $jobs                       = isset($filter['start_date']) ? $jobs->whereDate('start_date', $filter['start_date']) : $jobs;
        $jobs                       = isset($filter['end_date']) ? $jobs->whereDate('end_date', $filter['end_date']) : $jobs;
        $jobs                       = isset($filter['service_type']) ? $jobs->where('job_type_id', $filter['service_type']) : $jobs;
        $jobs                       = isset($filter['status']) ? $jobs->where('status', 'LIKE', '%' . $filter['status'] . '%') : $jobs;

        if (isset($filter['address'])) {
            $filter_address = $filter['address'];
            $jobs->whereHas('address', function ($q) use ($filter_address) {
                $q->where(function ($q) use ($filter_address) {
                    $q->where(DB::raw("concat(address,' ',zipcode)"), 'LIKE', '%' . $filter_address . '%');
                   // $q->where(DB::raw("concat(address, ' ', city, ' ', state, ' ', country, ' ', zipcode)"), 'LIKE', '%' . $filter_address . '%');
                });
            });
        }

        $jobs                       = $jobs->orderBy('id', 'desc')->paginate(20);
        $customers                  = User::get(['id', 'company']);
        $equipments                 = Equipment::get(['id', 'equipment_name']);
        $technicians                = Technician::get(['id', 'firstname', 'lastname']);
        $services                   = JobType::get(['id', 'type']);

        return view('admin.jobs.list', compact('jobs', 'customers', 'equipments', 'technicians', 'services', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers                  = User::get(['id', 'name', 'company']);
        $equipments                 = Equipment::get(['id', 'equipment_name']);
        $technicians                = Technician::get(['id', 'firstname', 'lastname']);
        $services                   = JobType::get(['id', 'type']);
        $addresses                  = UserAddress::get(['id','address']);
        $equipments                 = Equipment::get(['id','equipment_name']);


        return view('admin.jobs.create', compact('customers', 'equipments', 'technicians', 'services','addresses','equipments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'customer'                          => ['required'],
            'equipment'                         => ['required'],
            'address'                           => ['required'],
            'service_type'                      => ['required'],
            'technician'                        => ['required'],
            'description'                       => ['required'],
            'start_date'                        => ['required'],
            'start_time'                        => ['required'],
            'end_date'                          => ['required'],
            'end_time'                          => ['required'],
            'remark'                            => ['required'],
        ];

        $messages = [
            'customer.required'                 => 'Please choose customer / company.',
            'equipment.required'                => 'Please choose equipment.',
            'address.required'                  => 'Please choose address.',
            'service_type.required'             => 'Please choose service type.',
            'technician.required'               => 'Please choose technician.',
            'description.required'              => 'Please enter job description.',
            'start_date.required'               => 'Please choose start date.',
            'start_time.required'               => 'Please choose start time.',
            'end_date.required'                 => 'please choose end date',
            'end_time.required'                 => 'Please choose end time.',
        ];

        $this->validate($request, $rules, $messages);

        $job = Job::create([
            'user_id'           => $request->customer,
            'equipment_id'      => $request->equipment,
            'job_type_id'       => $request->service_type,
            'technician_id'     => $request->technician,
            'description'       => $request->description,
            'user_address_id'   => $request->address,
            'remark'            => $request->remark,
            'start_date'        => $request->start_date,
            'start_time'        => $request->start_time,
            'end_date'          => $request->end_date,
            'end_time'          => $request->end_time,
            'add_on_calendar'   => $request->has('add_on_calendar') ? true : false,
            'free_of_cost'      => $request->has('free_of_cost') ? true : false,

        ]);

        if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/jobs/'.$job->id.'/images', $image_name, 'public');
               JobImage::create([
                   'job_id'   => $job->id,
                   'name'     => $image_name
               ]);
           }
        }

        $update_Job = Job::find($job->id);

        $techniciansDetails = Technician::find($request->technician);

        $OfferNotifyToApp = $this->notifyApp($techniciansDetails->device_id);

        if($update_Job->jobType->type == 'Parts Replacement'){
             return redirect()->route('admin.jobs.parts-replacement', $job->id)->with('success', 'Job created sucessfully!');
        }else{
            return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully');
        }


    }

    public function notifyApp($app_id){
        $payload = array(
            'to' => $app_id,
            'sound' => 'default',
            'title'  => 'Shl Push Notification',
            'body' => "New Job has been assigned"
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://exp.host/--/api/v2/push/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Accept-Encoding: gzip, deflate",
            "Content-Type: application/json",
            "cache-control: no-cache",
            "host: exp.host"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // if ($err) {
        // echo "cURL Error #:" . $err;
        // } else {
        // echo $response;
        // }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $job = Job::find($id);
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $job                        = Job::find($id);
        $customers                  = User::get(['id', 'name', 'company']);
        $technicians                = Technician::get(['id', 'firstname', 'lastname']);
        $services                   = JobType::get(['id', 'type']);
        $equipments                 = Equipment::where('user_id', $job->user_id)->get();

        if($job->jobType->type == 'Parts Replacement' || $job->jobType->type == 'Repair' || $job->jobType->type == 'Within warranty works'){

            return view('admin.jobs.edit.job-details', compact('job', 'equipments', 'customers', 'technicians', 'services'));
        }else{

            return view('admin.jobs.edit', compact('job', 'equipments', 'customers', 'technicians', 'services'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'customer'                          => ['required'],
            'equipment'                         => ['required'],
            'address'                           => ['required'],
            'service_type'                      => ['required'],
            'technician'                        => ['required'],
            'description'                       => ['required'],
            'start_date'                        => ['required'],
            'start_time'                        => ['required'],
            'end_date'                          => ['required'],
            'end_time'                          => ['required'],
            'remark'                            => ['required'],
        ];

        $messages = [
            'customer.required'                 => 'Please choose customer / company.',
            'equipment.required'                => 'Please choose equipment.',
            'address.required'                  => 'Please choose address.',
            'service_type.required'             => 'Please choose service type.',
            'technician.required'               => 'Please choose technician.',
            'description.required'              => 'Please enter job description.',
            'start_date.required'               => 'Please choose start date.',
            'start_time.required'               => 'Please choose start time.',
            'end_date.required'                 => 'please choose end date',
            'end_time.required'                 => 'Please choose end time.',
        ];

        $this->validate($request, $rules, $messages);

        $job = Job::find($id)->update([
            'user_id'           => $request->customer,
            'equipment_id'      => $request->equipment,
            'job_type_id'       => $request->service_type,
            'technician_id'     => $request->technician,
            'description'       => $request->description,
            'user_address_id'   => $request->address,
            'remark'            => $request->remark,
            'start_date'        => $request->start_date,
            'start_time'        => $request->start_time,
            'end_date'          => $request->end_date,
            'end_time'          => $request->end_time,
            'add_on_calendar'   => $request->has('add_on_calendar') ? true : false,
            'free_of_cost'      => $request->has('free_of_cost') ? true : false,
        ]);

        if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/jobs/'.$id.'/images', $image_name, 'public');
               JobImage::create([
                   'job_id'   => $id,
                   'name'     => $image_name
               ]);
           }
        }

        $update_Job = Job::find($id);

        // $techniciansDetails = Technician::find($request->technician);

        // $OfferNotifyToApp = $this->notifyApp($techniciansDetails->device_id);

        if($update_Job->jobType->type == 'Parts Replacement'){
             return redirect()->route('admin.jobs.parts-replacement', $id)->with('success', 'Job details updated sucessfully!');
        }else{
            return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Job::find($id)->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully');
    }

    public function partReplacement($id){

        $job = Job::find($id);
        return view('admin.jobs.edit.parts-replacement', compact('job'));
    }

    public function savePartReplacement(Request $request, $id){

        $job = Job::find($id);

        $part = EquipmentPart::with('part', 'part.category')->find($request->part_id);

        EquipmentPart::create([
            'equipment_id'          => $job->equipment_id,
            'part_id'               => $request->part_name,
            'job_id'                => $job->id,
            'quantity'              => $request->quantity,
        ]);
        EquipmentReplacement::create([
            'equipment_id'          => $job->equipment_id,
            'part_id'               => $part->part_id,
            'job_id'                => $job->id,
            'quantity'              => $part->quantity,

        ]);

        // $part->installation_date    = $request->installation_date;
        // $part->warranty_upto        = $request->warranty_upto;
        $part->quantity             = $request->quantity;
        $part->replace              = true;
        $part->save();

        return redirect()->back()->with('success', 'Selected Part replaced successfully');

    }

    public function epod($id){

        $job = Job::find($id);

        return view('admin.jobs.epod', compact('job'));
    }

    public function downloadImages($id)
    {
        $job = Job::find($id)->load('images');

        //return view('admin.jobs.download-images', compact('job'));
        // $pdf = Pdf::loadView('hotels.downloads', compact('hotel'))->setPaper('a4', 'landscape');
        $pdf = Pdf::loadView('admin.jobs.download-images', compact('job'))->setPaper('a4', 'landscape');
        return $pdf->download('EPOD.pdf');
    }

    public function deleteEquipmentPart($id)
    {
        $job = EquipmentPart::find($id)->delete();

        return redirect()->back()->with('success', 'Part deleted successfully');
    }

    public function deleteImage(Request $request, $id){
        JobImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
