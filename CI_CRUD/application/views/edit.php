<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .preview-img {
            max-width: 120px;
            border-radius: 8px;
            margin-top: 8px;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo site_url('dashboard'); ?>">MyApp</a>
            <div class="d-flex">
                <a href="<?php echo site_url('users'); ?>" class="btn btn-outline-light btn-sm me-2">
                    Back to List
                </a>
                <a href="<?php echo site_url('logout'); ?>" class="btn btn-outline-light btn-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-sm p-4 w-100" style="max-width: 500px; border-radius: 12px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4 fw-bold">Edit Record</h3>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php echo form_open_multipart('users/update'); ?>

                <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="text" class="form-control" value="<?php echo $user->id; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name"
                        value="<?php echo $user->name; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">DOB</label>
                    <input type="date" class="form-control" name="dob"
                        value="<?php echo $user->dob; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" class="form-control" name="mob"
                        value="<?php echo $user->mob; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email"
                        value="<?php echo $user->email; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <?php if (!empty($user->image)): ?>
                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small><br>
                            <img src="<?php echo base_url('uploads/' . $user->image); ?>"
                                class="preview-img" alt="Current">
                        </div>
                    <?php endif; ?>
                </div>

                <input type="submit" class="btn btn-primary w-100 py-2 fw-semibold"
                    name="b1" value="Update">

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>

</html>