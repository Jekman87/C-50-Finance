<form action="change_pass.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="curPassword" placeholder="Current password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="newPassword" placeholder="New password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Confirm the password" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Change password</button>
        </div>
    </fieldset>
</form>
