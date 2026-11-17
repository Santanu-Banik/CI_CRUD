<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-sm p-4 w-100" style="max-width: 420px; border-radius: 12px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4 fw-bold">Login</h3>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open('login/process'); ?>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Login
                </button>

                <div class="text-center mt-3">
                    <span class="text-muted">Don't have an account?</span>
                    <a href="<?php echo site_url('register'); ?>" class="text-decoration-none">
                        Register
                    </a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>

</html>