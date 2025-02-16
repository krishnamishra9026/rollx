<?php

namespace App\Http\Controllers\Api\Technician;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Job;
use App\Models\Technician;
use App\Models\JobParcelProof;
use App\Models\JobParcelSignature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kutia\Larafirebase\Facades\Larafirebase;

class JobController extends Controller
{
    public function newJobs()
    {
        $id       = Auth::user()->id;

        $start = Carbon::createFromTime('07', '00');
        $now = Carbon::now('GMT+8');

        $jobs     = Job::where('technician_id', $id)
            ->whereIn('status', ['pending', 'progress'])
            ->where('start_date', '=', Carbon::today()->format('Y-m-d'))
            ->whereBetween('start_time', [$start, $now])
            ->orderBy('id', 'desc')->paginate(3);

        $jobs   = $jobs->through(function ($job) {
            return [
                'job_id'            => $job->id,
                'job_description'   => $job->description,
                'customer'          => $job->customer->name,
                'address'           => $job->address->address . ' ' . $job->address->zipcode,
                'latitude'          => $job->address->latitude,
                'longitude'         => $job->address->longitude,
                'equipment'         => $job->equipment->equipment_name,
                'service_type'      => $job->jobType->type,
                'start_at'          => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->start_time)->format('h:i A'),
                'end_at'            => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->end_time)->format('h:i A'),
                'time_ago'          => Carbon::parse($job->created_at)->diffForHumans(),
                'remark'            => $job->remark,
                'images'            => $job->images->map(function ($image) use ($job) {
                    return [
                        'image_url'    => asset('storage/uploads/jobs/' . $job->id . '/images' . '/' . $image->name),
                        'image_name'   => $image->name,
                    ];
                }),
                'status'            => $job->status
            ];
        });

        return response()->json([
            'success' => 'New Jobs fetched successfully!',
            'jobs'    => $jobs
        ], 200);
    }

    public function completedJobs()
    {

        $id       = Auth::user()->id;

        $startOfCurrentWeek = Carbon::now()->startOfWeek();
        $startOfLastWeek  = $startOfCurrentWeek->copy()->subDays(7);
        $startOfLastWeek  = Carbon::now()->subDays(7)->startOfWeek()->format('Y-m-d');

        $today = Carbon::today()->format('Y-m-d');

        $jobs = Job::where('technician_id', $id)->whereIn('status', ['completed'])
            ->whereBetween('start_date', [$startOfLastWeek, $today])
            ->orderBy('updated_at', 'desc')->paginate(3);

        $jobs   = $jobs->through(function ($job) {
            return [
                'job_id'            => $job->id,
                'job_description'   => $job->description,
                'customer'          => $job->customer->name,
                'address'           => $job->address->address . ' ' . $job->address->zipcode,
                'latitude'          => $job->address->latitude,
                'longitude'         => $job->address->longitude,
                'equipment'         => $job->equipment->equipment_name,
                'service_type'      => $job->jobType->type,
                'start_at'          => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->start_time)->format('h:i A'),
                'end_at'            => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->end_time)->format('h:i A'),
                'time_ago'          => Carbon::parse($job->created_at)->diffForHumans(),
                'remark'            => $job->remark,
                'images'            => $job->images->map(function ($image) use ($job) {
                    return [
                        'image_url'    => asset('storage/uploads/jobs/' . $job->id . '/images' . '/' . $image->name),
                        'image_name'   => $image->name,
                    ];
                }),
                'status'            => $job->status
            ];
        });

        return response()->json([
            'success' => 'New Jobs fetched successfully!',
            'jobs'    => $jobs
        ], 200);
    }

    public function viewJob($id)
    {

        $job = Job::find($id);

        $data =  [
            'job_id'            => $job->id,
            'job_description'   => $job->description,
            'customer'          => $job->customer->name,
            'customer_email'    => $job->customer->email,
            'customer_phone'    => $job->customer->contact,
            'address'           => $job->address->address . ' ' . $job->address->zipcode,
            'latitude'          => $job->address->latitude,
            'longitude'         => $job->address->longitude,
            'equipment'         => $job->equipment->equipment_name,
            'service_type'      => $job->jobType->type,
            'start_at'          => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->start_time)->format('h:i A'),
            'end_at'            => Carbon::parse($job->start_date)->format('d-m-Y') . ' | ' . Carbon::parse($job->end_time)->format('h:i A'),
            'time_ago'          => Carbon::parse($job->created_at)->diffForHumans(),
            'remark'            => $job->remark,
            'images'            => $job->images->map(function ($image) use ($job) {
                return [
                    'image_url'    => asset('storage/uploads/jobs/' . $job->id . '/images' . '/' . $image->name),
                    'image_name'   => $image->name,
                ];
            }),
            'parts'             => $job->equipment->parts->map(function ($part) use ($job) {
                return [
                    'part_id'           => '#' . $part->part_id,
                    'category'          => $part->part->category->category,
                    'part'              => $part->part->part,
                    'model_number'      => $part->part->model_number,
                    'serial_number'     => $part->part->serial_number,
                    'quantity'          => $part->quantity,
                    'installation_date' => Carbon::parse($part->installation_date)->format('M d, Y'),
                    'warranty_upto'     => Carbon::parse($part->warranty_upto)->format('M d, Y'),

                ];
            }),
            'status'            => $job->status
        ];

        return response()->json([
            'success' => 'Job has been fetched successfully!',
            'job'    => $data,
        ], 200);
    }

    public function markComplete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'job_id'  => ['required'],
            'photos'  => ['required', 'array']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $imageRules = array(
            'photos' => 'image|max:2000'
        );
        foreach ($request->photos as $image) {
            $image = array('photos' => $image);

            $imageValidator = Validator::make($image, $imageRules);

            if ($imageValidator->fails()) {

                return response()->json(['errors' => $imageValidator->messages()]);
            }
        }


        $id       = Auth::user()->id;

        Job::where('id', $request->job_id)->where('technician_id', $id)->update([
            'status' => 'completed',
            'technician_remark' => $request->remark
        ]);

        $job        = Job::where('id', $request->job_id)->first();

        if ($request->has('signature')) {

            JobParcelSignature::create([
                'job_id'        => $job->id,
                'user_id'       => $job->user_id,
                'technician_id'     => $id,
                'signature'     => $request->signature,
            ]);
        }

        if (!empty($request->photos) && is_array($request->photos)) {
            foreach ($request->photos as $key => $file) {
                if ($request->hasFile('photos.' . $key)) {
                    $document                         = $file;
                    $file_name                        = time() . $key . '.' . $document->getClientOriginalExtension();
                    $document->storeAs('uploads/jobs/' . $job->id . '/proof', $file_name, 'public');

                    JobParcelProof::create([
                        'job_id'        => $job->id,
                        'user_id'       => $job->user_id,
                        'technician_id' => $id,
                        'photo'         => $file_name,
                    ]);
                }
            }
        }


        $administrators = Administrator::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('Puchase Order Status Updated')
            ->withBody('Job#' . $job->id .  ' has been marked completed by technician!')
            ->sendMessage($administrators);

        return response()->json([
            'success' => 'Job has been marked completed successfully!',
        ], 200);
    }
}
