<div class="form-group">
  <label for="name" class="col-md-3 control-label">
    Name
  </label>
  <div class="col-md-8">
    <input type="text" class="form-control" name="name"
           id="name" @if(isset($user))  value="{{$user->name}}" @endif>
  </div>
</div>

<div class="form-group">
  <label for="email" class="col-md-3 control-label">
    Email
  </label>
  <div class="col-md-8">
    <input type="email" class="form-control" name="email"
           id="email"  @if(isset($user))  value="{{$user->email}}" @endif>
  </div>
</div>

@if(!isset($user))   
<div class="form-group">
  <label for="password" class="col-md-3 control-label">
    Password
  </label>
  <div class="col-md-8">
    <input type="password" class="form-control" name="password"
           id="password">
  </div>
</div>
<div class="form-group">
  <label for="password_confirmation" class="col-md-3 control-label">
    Confirm Password
  </label>
  <div class="col-md-8">
    <input type="password" class="form-control" name="password_confirmation"
           id="password_confirmation">
  </div>
</div>
@endif

<div class="form-group">
  <label for="meta_description" class="col-md-3 control-label">
    Role
  </label>
  <div class="col-md-8">
    <select name="role_type" class="form-control">
     <option value="">Select Role</option>
     <option value="1" @if(isset($user)) @if($user->role_type ==1) selected @endif @endif >Admin</option>
     <option value="2" @if(isset($user)) @if($user->role_type ==2) selected @endif @endif>Author</option>
     <option value="3" @if(isset($user)) @if($user->role_type ==3) selected @endif @endif>User</option>
    </select>
  </div>
</div>


