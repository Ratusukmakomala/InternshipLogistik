<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="name"
            type="text"
            label="name"
            placeholder="Enter Name"
            icon="bi bi-card-text"
            :value="isset($user) ? $user->name : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="email"
            type="text"
            label="Email"
            placeholder="Enter Email"
            icon="bi bi-envelope"
            :value="isset($user) ? $user->email : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.input
            name="password"
            type="password"
            label="Password"
            placeholder="Enter Password"
            icon="bi bi-lock"
        />
    </div>
    <div class="col-md-6">
        <x-form.input
            name="password_confirmation"
            type="password"
            label="Confirm Password"
            placeholder="Enter Confirm Password"
            icon="bi bi-lock-fill"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.select
            name="role_id"
            label="Select Role"
            :options="$roles"
            :value="isset($user) ? $user->role_id : ''"
        />
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
