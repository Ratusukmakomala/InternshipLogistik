<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="code"
            type="text"
            label="Code"
            placeholder="Enter Code"
            icon="bi bi-braces"
            :value="isset($customer) ? $customer->code : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="name"
            type="text"
            label="Name"
            placeholder="Enter Name"
            icon="bi bi-braces"
            :value="isset($customer) ? $customer->name : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="phone"
            type="text"
            label="Phone"
            placeholder="Enter Phone"
            icon="bi bi-braces"
            :value="isset($customer) ? $customer->phone : ''"
        />
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <x-form.textarea
            name="address"
            label="Address"
            placeholder="Enter Address"
            :value="isset($customer) ? $customer->address : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="zip_code"
            type="text"
            label="Zip Code"
            placeholder="Enter Zip Code"
            icon="bi bi-braces"
            :value="isset($customer) ? $customer->zip_code : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="type"
            type="text"
            label="Type"
            placeholder="Enter Type"
            icon="bi bi-braces"
            :value="isset($customer) ? $customer->type : ''"
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
            :value="isset($customer) ? $customer->user->email : ''"
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
