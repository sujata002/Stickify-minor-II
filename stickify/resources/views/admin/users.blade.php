<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Stickify Admin - Users List</title>
    <link rel="icon" href="{{ asset('logo/documentlogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
</head>
<body>

    <div class="sidebar">
        <h2>STICKIFY</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa fa-user"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link active">
                    <i class="fa fa-list"></i> Users List
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.logout') }}" class="nav-link">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <nav class="navbar">
            <span>Stickify Admin Dashboard</span>
            <a href="#"><i class="fa fa-user"></i> Profile</a>
        </nav>

        <div class="container mt-4">

            <!-- for displaying updation successfull message-->
            @if(session('success'))
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="card p-4">
                <h5 class="mb-3">Users List</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)           <!-- using loop to display users -->
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ ucfirst($user->role) }}</td> --}}
                                <td>
                                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>

                                <td>

                                    <!-- edit button triggers modal..(we can link to an edit page later) -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- Delete button -->
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                            <!-- modal is placed here, outside of <tr> but inside the loop -->
                            <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">Manage User: {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-around">
                                    
                                    <!-- promote Button Form -->
                                    @if (!$user->is_premium)
                                    <form action="{{ route('admin.users.promote', $user->id) }}" method="POST" onsubmit="return confirm('Promote this user to Premium?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-star"></i> Promote to Premium
                                    </button>
                                    </form>
                                    @else
                                    <span class="badge bg-warning align-self-center">Already Premium</span>
                                    @endif

                                    <!-- edit Profile Button -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                                    <i class="fa fa-user-edit"></i> Edit Profile
                                    </a>

                                </div>
                                </div>
                            </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    flash.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateY(-10px)';

                    setTimeout(() => {
                        flash.remove();
                    }, 500); // match with transition duration
                }, 2000); // show for 2 seconds
            }
        });
    </script>

</body>
</html>
