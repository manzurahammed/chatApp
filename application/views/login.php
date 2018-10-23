<div class="login-from">
    <form action="<?php echo base_url('welcome/login'); ?>" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="username" required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" required type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>