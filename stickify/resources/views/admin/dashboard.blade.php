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
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class = "d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Add New User</h5>
                            <button class = "btn btn-success" onclick="document.getElementById('itemform').reset();">
                                <i class = "fa fa-plus"></i>New Form
                            </button>
                        </div>
                    
                        <!-- for adding new user through admin dashboard-->
                        <form action="" id="itemform">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label"> Name:</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" required>
                                </div>
                        </div>   

                            <div class="mb-3 row">
                                <label for="email" class="col-md-3 col-form-label">Email:</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="role" class="col-md-3 col-form-label">Role:</label>

                                <div class="col-md-9">
                                    <select class="form-select" id="role">
                                        <option selected>Choose...</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <button type="submit" class="btn btn-primary w-50">Submit</button> --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>  

                <div class="col-md-12">
                    <div class="card p-4">           <!-- this is for graph showing the number of users -->
                        <h5 class="text-center mb-3">Total Users Overview</h5>
                        <canvas id="userChart" height="210"></canvas>
                    </div>
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

        // for user graph

        const ctx = document.getElementById('userChart').getContext('2d');

        const userChart = new Chart(ctx, {
            type: 'line', // this can be changed to 'line', 'pie', etc 
            data: {
                labels: ['Free Users', 'Premium Users', 'Admins'], // Example categories
                datasets: [{
                    label: 'User Count',
                    data: [10, 5, 1], // this number is statis for now and can be replaced with dynamic values later
                    backgroundColor: [
                    '#198754',
                    '#0dcaf0',
                    '#ffc107'
                    ],
                    borderWidth: 4
                }]
            },
            // options: {
            //     responsive: true,
            //     scales: {
            //         y: {
            //             beginAtZero: true
            //         }
            //     }
            // }

            options: {
                plugins: {
                    legend: {
                        onClick: null // disables the toggle behavior when clicking on user count in graph 
                    }
                }
            }
        });

    </script>
</body>
</html>

   

{{-- dashboard lai dynamic banauna baki cha!! first ma authenticate wala part garne aba--}}