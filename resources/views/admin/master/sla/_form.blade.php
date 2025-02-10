<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="name"
            type="text"
            label="Name"
            placeholder="Enter Sla Name"
            icon="bi bi-card-text"
            :value="isset($sla) ? $sla->name : ''"
        />
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <x-form.textarea
            name="description"
            label="Description"
            placeholder="Enter Description"
            :value="isset($sla) ? $sla->description : ''"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.input
            name="target"
            type="number"
            label="Target"
            placeholder="Enter target"
            icon="bi bi-123"
            :value="isset($sla) ? $sla->target : ''"
        />
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
