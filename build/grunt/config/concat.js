module.exports = {
    options: {
        separator: ';'
    },
    admin: {
        src: [
            '<%= paths.js.src %>/charcoal/admin/polyfill.js',
            '<%= paths.js.src %>/charcoal/admin/charcoal.js',
            '<%= paths.js.src %>/charcoal/admin/component_manager.js',
            '<%= paths.js.src %>/charcoal/admin/feedback.js',
            '<%= paths.js.src %>/charcoal/admin/widget.js',
            '<%= paths.js.src %>/charcoal/admin/widget/*.js',
            '<%= paths.js.src %>/charcoal/admin/property.js',
            '<%= paths.js.src %>/charcoal/admin/property/*.js',
            '<%= paths.js.src %>/charcoal/admin/property/input/**/*.js',
            '<%= paths.js.src %>/charcoal/admin/template.js',
            '<%= paths.js.src %>/charcoal/admin/template/*.js',
            '<%= paths.js.src %>/charcoal/admin/template/**/*.js',
        ],
        dest: '<%= paths.js.dist %>/charcoal.admin.js'
    },
    vendors: {
        src: [
            //URL Search Params
            'node_modules/url-search-params/build/url-search-params.js',
            // Bootstrap Switch
            // 'bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js',
            // Bootstrap Dialog
            // 'bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js',
            // Bootstrap 3 Datepicker
            // 'bower_components/moment/min/moment.min.js',
            // 'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            // BB Map
            'node_modules/beneroch-gmap/assets/scripts/dist/min/gmap.min.js',
            // Bootstrap Select
            // 'bower_components/bootstrap-select/dist/js/bootstrap-select.js',
            // Jquery Minicolors
            'node_modules/jquery-minicolors/jquery.minicolors.min.js',
            // Multiselect Two-sides
            'node_modules/multiselect/dist/js/multiselect.min.js',
            // Selectize
            'node_modules/selectize/dist/js/standalone/selectize.min.js',
            // Selectize
            'node_modules/clipboard/dist/clipboard.min.js'
        ],
        dest: '<%= paths.js.dist %>/charcoal.admin.vendors.js',
        separator: "\n"
    }
};