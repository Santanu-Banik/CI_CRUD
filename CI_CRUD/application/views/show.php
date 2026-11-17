<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo site_url('dashboard'); ?>">MyApp</a>
            <div class="d-flex align-items-center">
                <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-outline-light btn-sm me-2">
                    Dashboard
                </a>
                <a href="<?php echo site_url('logout'); ?>" class="btn btn-outline-light btn-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="card shadow-sm p-4" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-title mb-0 fw-bold">Student List</h3>
                    <a href="<?php echo site_url('register'); ?>" class="btn btn-success">
                        + Create Record
                    </a>
                </div>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($user->image)): ?>
                                                <img src="<?php echo base_url('uploads/' . $user->image); ?>"
                                                    class="img-thumb" alt="Profile">
                                            <?php else: ?>
                                                <span class="text-muted">No Image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $user->id; ?></td>
                                        <td><?php echo $user->name; ?></td>
                                        <td><?php echo $user->dob; ?></td>
                                        <td><?php echo $user->mob; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->create_at; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('users/edit/' . $user->id); ?>"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?php echo site_url('users/delete/' . $user->id); ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?');">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>