<div class="row">
    <div class="col-md-6">
        <x-form.input
            name="shipping_form"
            type="text"
            label="Shipping Form"
            placeholder="Enter Name"
            icon="bi bi-card-text"
        />
    </div>

    <div class="col-md-6">
        <x-form.input
            name="type_of_goods"
            type="text"
            label="Type of Goods"
            placeholder="Enter Type of Goods"
            icon="bi bi-card-text"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <x-form.select
            name="sla_id"
            label="Select SLA"
            :options="$slas"
        />
    </div>

    <div class="col-md-3">
        <x-form.select
            name="kind_of_delivery"
            label="Select Kind of Delivery"
            :options="$kindOfDeliveries"
        />
    </div>

    <div class="col-md-3">
        <x-form.select
            name="type"
            label="Select Type"
            :options="$types"
        />
    </div>

    <div class="col-md-3">
        <x-form.select
            name="delivery_type"
            label="Select Delivery Type"
            :options="$deliveryTypes"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <x-form.input
            name="weight"
            type="number"
            label="Weight"
            placeholder="Enter Weight"
            icon="bi bi-card-text"
        />
    </div>

    <div class="col-md-4">
        <x-form.input
            name="volume"
            type="number"
            label="Volume"
            placeholder="Enter volume"
            icon="bi bi-card-text"
        />
    </div>

    <div class="col-md-4">
        <x-form.input
            name="item_value"
            type="number"
            label="Item Value"
            placeholder="Enter Item Value"
            icon="bi bi-card-text"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.input
            name="base_price"
            type="number"
            label="Base Price"
            placeholder="Enter Base Price"
            icon="bi bi-card-text"
        />
    </div>

    <div class="col-md-6">
        <x-form.input
            name="tax_price"
            type="number"
            label="Tax Price"
            placeholder="Enter Tax Price"
            icon="bi bi-card-text"
        />
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <x-form.textarea
            name="note"
            label="Note"
            placeholder="Enter Note"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.select
            name="patner_id"
            label="Select Partner"
            :options="$partners"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.select
            name="sender_id"
            label="Select Sender"
            :options="$customers"
        />
    </div>

    <div class="col-md-6">
        <x-form.select
            name="receiver_id"
            label="Select Receiver"
            :options="$customers"
        />
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-primary float-end">Submit</button>
    </div>
</div>
