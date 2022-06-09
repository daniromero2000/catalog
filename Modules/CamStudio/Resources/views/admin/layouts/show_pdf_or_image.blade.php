@if (pathinfo($data, PATHINFO_EXTENSION) == 'pdf')
<div class="modal-body d-flex flex-column align-items-stretch" style="height: 600px">
    <object data="{{ asset("storage/$data") }}" type="application/pdf"
        style="height: 100%;">
        <embed src="{{ asset("storage/$data") }}" type="application/pdf"
            class="img-fluid lazy" frameborder="0">
    </object>
</div>
@else
<div class="modal-body d-flex flex-column align-items-center">
    <img style="max-height: 550px ; max-width: 100%;" src="{{ asset("storage/$data") }}" alt="image">
</div>
@endif
