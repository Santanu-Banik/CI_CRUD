<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo site_url('dashboard'); ?>">MyApp</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    Hello, <strong><?php echo $this->session->userdata('user_name'); ?></strong>
                </span>
                <a href="<?php echo site_url('logout'); ?>" class="btn btn-outline-light btn-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Personalised Welcome Card -->
        <div class="card shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body d-flex align-items-center">
                <?php if (!empty($user->image)): ?>
                    <img src="<?php echo base_url('uploads/' . $user->image); ?>"
                        class="profile-img me-4" alt="Profile">
                <?php else: ?>
                    <div class="profile-img me-4 bg-secondary d-flex align-items-center 
                                justify-content-center text-white fw-bold">
                        <?php echo strtoupper(substr($user->name, 0, 1)); ?>
                    </div>
                <?php endif; ?>

                <div>
                    <h4 class="mb-1">Welcome, <?php echo $user->name; ?>!</h4>
                    <p class="mb-0 text-muted">
                        <?php echo $user->email; ?> | ID: <?php echo $user->id; ?>
                    </p>
                    <small class="text-muted">
                        Member since: <?php echo date('d M Y', strtotime($user->create_at)); ?>
                    </small>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <a href="<?php echo site_url('users'); ?>"
                    class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Manage Users</h5>
                        <p class="text-muted mb-0">View / Edit / Delete all records</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('users/edit/' . $user->id); ?>"
                    class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Edit My Profile</h5>
                        <p class="text-muted mb-0">Update your personal details</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('register'); ?>"
                    class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Add New User</h5>
                        <p class="text-muted mb-0">Create a new account</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Users Table Preview -->
        <div class="card shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white">
                <h5 class="mb-0">All Registered Users</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($u->image)): ?>
                                            <img src="<?php echo base_url('uploads/' . $u->image); ?>"
                                                style="width:40px;height:40px;object-fit:cover;border-radius:50%;">
                                        <?php else: ?>
                                            <span class="badge bg-secondary">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $u->name; ?></td>
                                    <td><?php echo $u->email; ?></td>
                                    <td><?php echo $u->mob; ?></td>
                                    <td><?php echo date('d M Y', strtotime($u->create_at)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>