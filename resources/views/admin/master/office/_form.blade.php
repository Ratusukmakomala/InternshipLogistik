
<div class="row">
    <div class="col-md-12">
        <x-form.select
            name="parent_id"
            label="Select parent"
            :options="$parents"
            :value="isset($office) ? $office->parent_id : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="code"
            type="text"
            label="Code"
            placeholder="Enter Code"
            icon="bi bi-braces"
            :value="isset($office) ? $office->code : ''"
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
            icon="bi bi-card-text"
            :value="isset($office) ? $office->name : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="region"
            type="text"
            label="Region"
            placeholder="Enter Region"
            icon="bi bi-map"
            :value="isset($office) ? $office->region : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.select
            name="type"
            label="Select type"
            :options="$types"
            :value="isset($office) ? ($office->type == 'KCU' ? 0 : ($office->type == 'KC' ? 1 : ($office->type == 'KCP' ? 2 : ''))) : ''"
        />
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <x-form.textarea
            name="address"
            label="Address"
            placeholder="Enter Address"
            :value="isset($office) ? $office->address : ''"
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
            icon="bi bi-postage"
            :value="isset($office) ? $office->zip_code : ''"
        />
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
