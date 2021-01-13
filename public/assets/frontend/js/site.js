$(document).ready(function () {
    SITE.btnScrollTop();
    SITE.btnClickPopup();
    SITE.btnContact();
    SITE.btnLoginUser();
    SITE.btnDropdown();
})

SITE = {
    btnScrollTop:function () {
        $(window).scroll(function () {
            let scrol = $(window).scrollTop();
            if (scrol > 300){
                $('.btnTop').addClass('active')
            }
            else{
                $('.btnTop').removeClass('active')
            }
        });
        $('.btnTop').click(function () {
            $("html,body").animate({scrollTop: 0});
            return true;
        })
    },
    btnClickPopup:function () {
        $('.clickPopup').click(function () {
            $('#myModal').modal('show');
        });
    },
    btnContact:function () {
        $('.submitContact').click(function () {
            var valid = true;
            if ($('.txtEmail').val() == ''){
                $('.txtEmail').addClass('error');
                alert('Mail không được rỗng')
                valid = false;
            }
            else {
                var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                var mail = $('.txtEmail').val();
                if (regex.test(mail)){
                    $('.txtEmail').removeClass('error');
                }
                else{
                    $('.txtEmail').addClass('error');
                    alert('Không đúng định dạng email');
                    valid = false;
                }
            }
            if ($('.txtTitle').val() == ''){
                $('.txtTitle').addClass('error');
                alert('Tiêu đề không được trống');
                valid = false;
            }
            else{
                $('.txtTitle').removeClass('error');
            }
            if ($('.txtContent').val() == ''){
                $('.txtContent').addClass('error');
                alert('Nội dung không được rỗng');
                valid = false;
            }
            else{
                $('.txtContent').removeClass('error');
            }

            if (valid == false){
                return false;
            }
            return valid;
        })
    },

    btnLoginUser:function () {
        $(document).on("click",".popupSV",function() {
            $('#myModalLogin').modal('show');
            return false;
        });
    },

    btnDropdown:function () {
        $('.name-user').click(function () {
            $('.dropdown-show').toggleClass('active');
        })
    }
}