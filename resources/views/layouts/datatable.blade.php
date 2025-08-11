<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/@vuepic/vue-datepicker@latest"></script>


<script type="text/javascript">
    $.fn.dataTable.ext.buttons.reload = {
        text: '<i class="fa fa-refresh"></i>',
        attr: {
            class: 'btn border btn-light btn-sm px-3'
        },
        action: function(e, dt, node, config) {
            dt.ajax.reload();
        }
    };

    $.extend(true, $.fn.dataTable.defaults.oLanguage.oPaginate, {
        sNext: '<i class="fa fa-chevron-right" ></i>',
        sPrevious: '<i class="fa fa-chevron-left" ></i>'
    });


    $.fn.dataTable.ext.buttons.add = {
        text: '<i class="fa fa-plus"></i>',
        attr: {
            class: 'btn border btn-light btn-sm px-3',
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modal-form'

        },
        action: function(e, dt, node, config) {
            app.showForm(0, 'add');
        }
    };

    $.fn.dataTable.ext.buttons.delete = {
        text: '<i class="fa fa-trash"></i>',
        attr: {
            class: 'btn border btn-light btn-sm px-3',
        },
        action: function(e, dt, node, config) {
            app.destroyMultiple();
        }
    };

    $.fn.dataTable.ext.buttons.import = {
        text: '<i class="fa fa-upload"></i>',
        attr: {
            class: 'btn border btn-light btn-sm px-3',
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modal-upload'
        },
        action: function(e, dt, node, config) {
            $('#upload-file').val('');
        }
    };

    $.fn.dataTable.ext.buttons.export = {
        text: '<i class="fa fa-file"></i>',
        attr: {
            class: 'btn border btn-light btn-sm px-3'
        },
        action: function(e, dt, node, config) {
            let url = dt.ajax.url() + '/export?' + decodeURIComponent($.param(dt.ajax.params()));

            axios({
                method: 'GET',
                url: url,
                responseType: 'blob',
            }).then(response => {

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'inventory.csv');
                document.body.appendChild(fileLink);
                fileLink.click();

            });
        }
    };

    $(function() {
        if ($('.select2').length > 0) {
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
        }

        if ($('.select-store').length > 0) {
            $('.select-store').select2({
                width: '200px'
            });
        }

        if ($('.select-filter').length > 0) {
            $('.select-filter').on('change', function() {
                app.filterOptional();
            });
        }
    });
</script>

<script>
    const {
        createApp
    } = Vue;
    var app = createApp({
        components: {
            Datepicker: VueDatePicker
        },
        data() {
            return {
                datas: [],
                status: false,
                filter_optional: {},
                form: {
                    closebook: {}
                },
                url: '{{ url()->current() }}',
                table: {},
                options: {
                    'clicked': false,
                    'serverSide': true,
                    'serverSideDetail': false,
                    'columns': [],
                    'buttons': [],
                },
            }
        },
        mounted: function() {
            if (typeof options !== 'undefined') {
                this.options = options;
            }
            this.makeDatatable();
        },
        methods: {
            makeDatatable: function() {
                const _this = this;

                _this.table = $('#datatable').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: _this.options.serverSide,
                    scrollY: "500px",
                    scrollCollapse: true,
                    scrollX: true,
                    fixedHeader: {
                        header: true
                    },
                    pageLength: 25,
                    ajax: {
                        url: this.url,
                        data: function(d) {

                            if ($('#filter_optional').length > 0) {

                                let form = new FormData(document.getElementById(
                                    'filter_optional'));

                                for (let [key, value] of form) {
                                    d[key] = value;
                                }
                            }

                        },
                    },
                    dom: "<'container-fluid'<'row py-2 py-md-0'<'col-sm-12 col-md-6 px-2 pt-2 'f><'col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end pt-2 px-2 align-items-center 'Bl>>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'container-fluid'<'row py-2 py-md-0'<'col-sm-12 col-md-5 py-2 py-md-3 px-md-4 d-flex justify-content-md-start align-items-center'i><'col-sm-12 col-md-7 py-2 py-md-3 px-md-4'p>>>",
                    columns: this.options.columns,
                    buttons: {
                        dom: {
                            container: {
                                className: 'dt-buttons me-1'
                            }
                        },
                        buttons: this.options.buttons
                    },
                    search: {
                        return: true,
                    },
                    language: {
                        search: '',
                        lengthMenu: "Show _MENU_",
                        searchPlaceholder: '{{ __('table.search') }}',
                        url: "{{ asset('lang') . '/' . (auth()->user()->lang ?? 'ja') . '.json' }}",
                    },
                }).on('xhr.dt', function(e, settings, json, xhr) {
                    _this.datas = json.data;
                });

                if (_this.options.clicked === true) {
                    $('#datatable tbody').on('click', 'tr', function() {
                        let data = _this.table.api().row(this);

                        if (_this.options.targetAction == 'href') {
                            window.location.href = _this.options.targetUrl;
                        } else {
                            if (_this.options.serverSideDetail) {
                                data = data.data();
                                _this.showFormID(data[_this.options.targetAction ? _this.options.targetAction : 'id']);
                            } else {
                                _this.showForm(data.index());
                            }
                            $('#modal-form').modal('show');
                        }
                    });
                }
            },
            getDataById: function(id) {
                const _this = this;
                axios.get(_this.url + '/' + id + '/edit ').then(response => {
                    if (response.data.data) {
                        _this.form = response.data.data;
                    }
                });
            },

            showById: function(id) {
                const _this = this;
                this.preloader(true);

                axios.get(_this.url + '/' + id).then(response => {
                    if (response.data.data) {
                        _this.form = response.data.data;
                        this.preloader();
                    }
                }).catch(error => {
                    this.preloader();
                });
            },

            showForm: function(index, type = 'edit') {
                const _this = this;
                _this.status = type == 'edit' ? true : false;
                _this.form = type == 'edit' ? _this.datas[index] : {};

                if ($('#picture').length > 0) {
                    $('#picture').val('');
                    var output = document.getElementById('output');
                    output.src = '';
                }

                if (_this.status) {
                    $('#postal_code').val(_this.form?.postal_code);
                    $('#province').val(_this.form?.province);
                    $('#city').val(_this.form?.city);
                    $('#district').val(_this.form?.district);
                    $('#detail-address').val(_this.form?.province + _this.form?.city + _this.form?.district);
                } else {
                    if ($('#postal_code').length > 0) {
                        $('#postal_code').val('');
                        $('#province').val('');
                        $('#city').val('');
                        $('#district').val('');
                        $('#detail-address').val('');
                    }
                }
            },
            showFormSS: function(id, type = 'edit') {
                const _this = this;
                _this.status = type == 'edit' ? true : false;

                if ($('#picture').length > 0) {
                    $('#picture').val('');
                    var output = document.getElementById('output');
                    output.src = '';
                }

                if (type == 'edit') {
                    _this.getDataById(id)
                } else {
                    _this.form = {}
                }
            },

            showFormID: function(id, type = 'edit') {
                const _this = this;
                _this.status = type == 'edit' ? true : false;

                if ($('#picture').length > 0) {
                    $('#picture').val('');
                    var output = document.getElementById('output');
                    output.src = '';
                }

                if (type == 'edit') {
                    _this.showById(id)
                } else {
                    _this.form = {}
                }
            },

            async loadFile(event) {
                this.preloader(true);
                let data = event.target.files[0];
                if (event.target.files[0] && event.target.files[0].name.includes(".HEIC")) {
                    let blobURL = URL.createObjectURL(event.target.files[0]);
                    let blobRes = await fetch(blobURL);
                    let blob = await blobRes.blob();
                    let conversionResult = await heic2any({
                        blob
                    });

                    data = conversionResult;
                }

                var output = document.getElementById('output');
                output.src = URL.createObjectURL(data);
                this.preloader(false);
            },
            submit(event) {
                this.preloader(true);
                const _this = this;

                let form = new FormData(event.target);
                form.append('_method', _this.status ? 'PUT' : 'POST');

                axios.post(_this.url + (_this.status ? `/${ _this.form.id }` : ''), form).then(response => {
                    $('#modal-form').modal('hide');

                    _this.table.api().ajax.reload();
                    this.preloader();
                }).catch(error => {
                    this.preloader();
                });
            },
            customSubmit(event) {
                this.preloader(true);

                let method = event.target.attributes.method.value;
                let action = event.target.attributes.action.value;
                let modal = event.target.dataset.modal;
                let form = new FormData(event.target);

                form.append('_method', method);

                axios.post(action, form).then(response => {
                    $('#' + modal).modal('hide');

                    this.table.api().ajax.reload();
                    this.preloader();
                }).catch(error => {
                    this.preloader();
                });
            },
            filterOptional: function() {
                const _this = this;
                _this.table.api().ajax.reload();
            },
            destroy: function(id) {
                const _this = this;

                Swal.fire({
                    title: '{{ __('form.command_delete') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('button.delete') }}',
                }).then((result) => {
                    this.preloader(true);
                    if (result.isConfirmed) {
                        axios.post(_this.url + '/' + id, {
                            '_method': 'DELETE'
                        }).then(response => {
                            _this.table.api().ajax.reload();
                            $('#modal-form').modal('hide');
                            this.preloader();
                        }).catch(error => {
                            this.preloader();
                        });
                    }
                });
            },
            destroyMultiple: function() {
                const _this = this;
                let checked = $('input[name="id"]:checked');
                let ids = [];

                checked.each(function() {
                    ids.push(this.value);
                });

                Swal.fire({
                    title: '{{ __('form.command_delete') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: `${ ids.length } {{ __('button.selected') }}`,
                }).then((result) => {
                    this.preloader(true);
                    if (result.isConfirmed) {
                        axios.post(_this.url + '/deletes', {
                            '_method': 'DELETE',
                            'ids': ids,
                        }).then(response => {
                            _this.table.api().ajax.reload();
                            this.preloader();
                        }).catch(error => {
                            this.preloader();
                        });;
                    }
                });
            },
            preloader: function(param = false) {
                if (document.querySelector('.loader-wrapper')) {
                    document.querySelector('.loader-wrapper').style.display = param ? 'flex' : 'none';
                }
            }
        }
    });
</script>
