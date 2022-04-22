let manager = {
    init: function() {
        this.submit()
    },
    submit: function() {
        $('#menu_submit').on('submit', function(e) {
            e.preventDefault()
            $this = $(this);
            const url = $this.attr('action')
            $.post(url, {})
                .done(function(data, text, jqxhr) {
                    var a = jqxhr.responseText
                    $(body).prepend(a)
                })
                .fail(function(jqxhr) {

                })
                .always(function() {

                })
        })
    },
    
}

$('document').ready(function(e) {
    manager.init()
})
