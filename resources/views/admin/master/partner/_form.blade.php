<div class="row">
    <div class="col-md-12">
        <x-form.select
            name="type"
            label="Select type"
            :options="$types"
            :value="isset($partner) ? ($partner->type == 'marketplace' ? 0 : ($partner->type == 'pemerintah' ? 1 : ($partner->type == 'perbankan' ? 2 : ''))) : ''"
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
            :value="isset($partner) ? $partner->code : ''"
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
            :value="isset($partner) ? $partner->name : ''"
        />
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
