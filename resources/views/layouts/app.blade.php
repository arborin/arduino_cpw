<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/easion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/easion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

    <script src="{{ asset('js/chart-js-config.js') }}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}">

    <title>Arduino CP</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="{{ route('dashboard') }}" class="easion-logo"><i class="fab fa-sith text-warning"></i><span>Arduino CP</span></a>
            </header>
            <nav class="dash-nav-list">
                <a href="{{ route('dashboard') }}" class="dash-nav-item">
                    <i class="fas fas fa-chart-pie "></i> Dashboard
                </a>
                <a href="{{ route('arduino.list') }}" class="dash-nav-item">
                    <i class="fas fa-infinity"></i> Arduino Nodes
                </a>



                @if (Auth::user()->role == "admin")

                    @php if (!isset($config_show)) $config_show = ''; @endphp

                    <div class="dash-nav-dropdown {{ $config_show }}">
                        <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                            <i class="fas fa-gear"></i> Configurations
                        </a>
                        <div class="dash-nav-dropdown-menu">
                            <a href="{{ route('user.list') }}" class="dash-nav-dropdown-item"> Users</a>
                        </div>
                        <div class="dash-nav-dropdown-menu">
                            <a href="{{ route('button.list') }}" class="dash-nav-dropdown-item">
                                Button Actions
                            </a>
                        </div>
                    </div>
                @endif

            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#!" class="searchbox-toggle">
                    <i class="fas fa-search"></i>
                </a>
                <!-- <form class="searchbox" action="#!">
                    <a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                    <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                    <input type="text" class="searchbox-input" placeholder="type to search">
                </form> -->
                <div class="tools">
                    <div class="dropdown ">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            {{-- <a class="dropdown-item" href="#!">Profile</a> --}}
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <main class="dash-content">
                <div class="container-fluid">


                    @yield('content')


                </div>
            </main>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}

    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    // <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="{{ asset('js/easion.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>


    <script type="text/javascript">
       $(function () {
            // $('#datetimepicker1').datetimepicker();

            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'

            });

            $('.date').datetimepicker({
                format: 'YYYY-MM-DD'
            });


        });

        // FOR MODAL DATE PERIOD
        $('#excel_export_modal').on('shown.bs.modal', function (e) {
            $('.date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>


    <script>
        var msg = '{{ Session::get('message') }}';

        if(msg){
            alertify.success(msg);
        }
    </script>

    @yield('javascript')
</body>

</html>
