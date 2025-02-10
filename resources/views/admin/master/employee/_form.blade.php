<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="code"
            type="text"
            label="code"
            placeholder="Enter Code"
            icon="bi bi-braces"
            :value="isset($employee) ? $employee->code : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="name"
            type="text"
            label="name"
            placeholder="Enter Name"
            icon="bi bi-card-text"
            :value="isset($employee) ? $employee->user->name : ''"
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
            :value="isset($employee) ? $employee->user->email : ''"
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

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
