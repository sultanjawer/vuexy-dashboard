<div class="col-md-6" wire:ignore>
    <label class="form-label">اختيار الفروع</label>
    <select class="js-select2-multi" multiple="multiple">
        @foreach (getBranches() as $branch)
            <option value="{{ $branch->id }}">
                {{ $branch->name }}</option>
        @endforeach
    </select>


    @push('test')
        <script>
            $(document).ready(function() {
                window.initSelectCompanyDrop = () => {
                    $('.js-select2-multi').select2({
                        placeholder: 'اختار الفروع',
                        allowClear: true
                    });
                }
                initSelectCompanyDrop();
                $(".js-select2-multi").on('change', function() {
                    console.log($(".js-select2-multi").val());
                    var data = $('.js-select2-multi').val();
                    @this.set('branches_ids', data);
                    window.livewire.emit('testing');
                });
                window.livewire.on('select2', () => {
                    initSelectCompanyDrop();
                });

                window.livewire.on('select3', (valuse) => {
                    @this.set('branches_ids', valuse);
                    $('.js-select2-multi').val(valuse);
                    console.log(valuse);
                    console.log("valuse");
                    window.livewire.emit('testing');

                });
            });
        </script>
    @endpush
</div>
