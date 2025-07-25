<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stickify Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>

    <div class="sidebar">
        <h2>STICKIFY</h2>
        <ul class="nav flex-column">
            <li class = "nav-item"><a href="#" class = "nav-link active"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>
            <li class = "nav-item"><a href="#" class = "nav-link"><i class="fa fa-user"></i>Profile</a></li>
            <li class = "nav-item">
                <a href="{{ route('admin.users') }}" class = "nav-link" target="_blank">
                    <i class="fa fa-list"></i>Users List
                </a>
            </li>
            <li class = "nav-item">
                <a href="{{ route('admin.logout') }}" class = "nav-link">
                    <i class="fa fa-sign-out-alt"></i>Logout
                </a>
            </li>
        </ul>                 <!-- yo logout ko logic baki cha so route mileko chaina. DO IT -->
    </div>

    <div class="content">
        <nav class="navbar">
            <span>Stickify Admin Dashboard</span>
            <a href="#"><i class="fa fa-user"></i>Profile</a>
        </nav>

        <div class="container mt-4">
            <div class="row"> 

                <!-- user count -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card card-custom-info text-white shadow"">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text fs-4">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-custom-success text-white shadow">
                            <div class="card-body">
                                <h5 class="card-title">Premium Users</h5>
                                <p class="card-text fs-4">{{ $premiumUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-custom-dark text-white shadow">
                            <div class="card-body">
                                <h5 class="card-title">Admins</h5>
                                <p class="card-text fs-4">{{ $adminCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- graph illustration -->
                <div class="col-md-10 mt-4 mb-4 mx-auto">                    <!-- mx-auto for centering the graph horizontally -->
                    <div class="card p-4">
                        <h5 class="text-center mb-3">User Signups (Last 6 Months)</h5>
                        <canvas id="signupChart" height="200"></canvas>
                    </div>
                </div>

            </div>

            <!-- for recent activity feed -->

            <!-- we will need a User field like updated_at or need to create a separate activities table for full logs later.
            but for now, we'll use users sorted by updated_at (last profile update or promotion)-->
            
                <div class="card mb-4 shadow mt-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Recent User Activity</h5>
                    </div>

                    <div class="card-body">
                        @if($recentUsers->isEmpty())
                            <p>No recent user activity.</p>
                        @else
                            <ul class="list-group">
                                @foreach($recentUsers as $user)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $user->name }}</strong> ({{ $user->email }})
                                            <div class="text-muted small">Last updated: {{ $user->updated_at->diffForHumans() }}</div>
                                        </div>
                                        <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    <!-- this is for integrating graph through chart.js (js library) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function () {
            // links is a nodeList of all <a> tags inside .sidebar. 
            // for each link in the sidebar, run this function. It is used for setting up click listener. link is just a temporary variable name used in the loop.

            let links = document.querySelectorAll(".sidebar a");

            links.forEach(link => {
                link.addEventListener("click", function () {
                    links.forEach(l => l.classList.remove("active"));           // l is also just a variable name for each link in the same list
                    this.classList.add("active");                       // this refers to the link that was just clicked. So it removes .active class from all links, then adds .active class to the clicked one.
                });
            });
        });

        // for user signups graph
        const signupCtx = document.getElementById('signupChart').getContext('2d');

        const signupChart = new Chart(signupCtx, {
            type: 'bar',
            data: {
                labels: @json($months), // dynamic month labels from controller
                datasets: [{
                    label: 'New Users',
                    data: @json($userCounts), // user count for each month
                    backgroundColor: '#8782E0',
                    // borderColor: '#0d6efd',
                    // borderWidth: 2,
                    borderRadius: 5,
                     // ✅ Slim bar settings
                    barPercentage: 0.3,
                    categoryPercentage: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} new users`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'User Count'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        },
                        ticks: {
                            autoSkip: false
                        },
                        grid: {
                            display: false
                        },
                    }
                }
            }
        });

    </script>
</body>
</html>

   