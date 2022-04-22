let admin = {
    min: false,
    init: function() {
        this.minimize();
    },
    minimize: function() {
        let minimize = this.min
        $('#min').on('click', (e)=>{
            // alert(minimize)
            const icon = $('#icon')
            let admin_tab = $('#admin')
            console.log(admin_tab)
            if(icon.hasClass("fa-caret-left")) {
                icon.removeClass('fa fa-caret-left')
                icon.addClass('fa fa-caret-right')
                admin_tab.css({
                    width:'70px'
                })
                minimize = false
            } else {
                icon.removeClass('fa fa-caret-right')
                icon.addClass('fa fa-caret-left')
                
                admin_tab.css({
                    width: '40vw'
                })
                $('(#admin *):not("#min, #min i")').css({
                    display: 'none'
                })
                minimize = true
            }

        })
    },

}

$('document').ready(function(e){
    admin.init()
})

