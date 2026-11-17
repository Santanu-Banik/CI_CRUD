<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-sm p-4 w-100" style="max-width: 500px; border-radius: 12px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4 fw-bold">Create an Account</h3>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open_multipart('register/save'); ?>

                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">DOB</label>
                    <input type="date" class="form-control" name="dob" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" class="form-control" name="mob" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <input type="submit" class="btn btn-primary w-100 py-2 fw-semibold"
                    name="b1" value="Register">

                <div class="text-center mt-3">
                    <a href="<?php echo site_url('login'); ?>" class="text-decoration-none">
                        Already have an account? Login
                    </a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>

</html>