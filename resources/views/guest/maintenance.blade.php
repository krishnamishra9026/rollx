<!doctype html>
<html lang="en">
    <head>
        <title>Maintenance</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"rel="stylesheet" />
    <style>
        .maintenance{
            padding-top: 30px;
        }
        .maintenance h1 {
            text-align: center;
            font-size: 40px;
            max-width: 60%;
            margin: 0 auto;
            color: #1a1a1a;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .maintenance p {
            line-height: 30px;
            font-weight: 500;
            font-size: 17px;
            color: #4F5C6A;
            text-align: center;
        }
        .maintenance img {
            max-width: 30%;
            margin: 0 auto;
            display: table;
        }
        .maintenance p.info {
            max-width: 60%;
            margin: 0 auto;
            margin-bottom: 15px;
        }
        @media (max-width: 767px) {
            .maintenance {
                padding-top: 100px;
            }
            .maintenance h1{
                max-width: 100%;
                font-size: 22px;
            }
            .maintenance p.info {
            max-width: 100%;
        }
        .maintenance img {
            max-width: 100%;
        }
        }
    </style>
    </head>

    <body>
        <div class="maintenance">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>We're currently performing some scheduled maintenance</h1>
                        <p>Thank you for your patience while we work to improve your experience.</p>
                        <p class="info">If you need assistance in the meantime, please contact us at <span style="color: #0657bb;">info@findmytradesman.es</span>
                            Stay tuned, and we'll be back shortly!</p>
                        <img src="{{ asset('assets/images/maintenance.png') }}" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    </body>
</html>
