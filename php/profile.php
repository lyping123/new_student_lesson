<?php include('header.php'); ?>

<div class="container">
    <h1>Profile Page</h1>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" class="form-control" value="<?=$_SESSION['username']?>" readonly>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="" >
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" class="form-control" value="" >
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" class="form-control">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" value="" >
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" class="form-control" value="" >
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
</div>

<?php include('footer.php'); ?>