<div class="col-md-6 mb-1" wire:ignore>
    <label class="form-label" for="search">رقم الجوال /
        الهوية</label>

    <select wire:model='search' class="select2  search-customer form-select">
        <option value="Hel">Helw</option>
        <option value="Hel1">Hel4</option>
        <option value="He2l">Hele</option>
        <option value="He3l">Hel2</option>
    </select>


    @push('test')
        <script>
            $(document).ready(function() {

                window.createSaleSelect2 = () => {
                    $('.search-customer').select2({
                        placeholder: 'رقم الهاتف/ رقم الهوية',
                        closeOnSelect: true
                    });
                }

                var search = $(".search-customer").data("select2").dropdown.$search;

                $(document).keyup(function() {
                    var search = $(".search-customer").data("select2").dropdown.$search;
                    var value = search.val();
                    if (value) {
                        @this.set('search', value);
                    }
                });


                search.bind("paste", function(e) {
                    var value = e.originalEvent.clipboardData.getData('text');
                    console.log(value);

                    if (value) {
                        @this.set('search', value);
                    }
                });


                window.livewire.on('selected-customers', (customers) => {
                    $('.search-customer').html('');
                    $('.search-customer').select2({
                        placeholder: 'رقم الهاتف/ رقم الهوية',
                        data: customers,
                        closeOnSelect: true
                    });
                });



                // window.livewire.on('select2', (check) => {
                //     createSaleSelect2();
                // });


            });
        </script>
    @endpush

</div>
