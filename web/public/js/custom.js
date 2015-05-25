/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var App = {
    submit: function () {

        if (jQuery('form#autologin').length > 0) {
            setTimeout(function () {
                jQuery('form#autologin').submit();
            }, 500);
        }
    },
    checkUser: function () {
        jQuery('.check').click(function () {
            if (jQuery(this).prop('checked')) {
                current = jQuery(this);
                jQuery('.check').prop('checked', false);
                current.prop('checked', true);
                p = jQuery(this).parent().parent().find('.id').html();
                if (!jQuery('.checkall').prop('checked{')) {
                    jQuery(document).find('.del-user').attr('href', 'users/delete?id=' + jQuery.trim(p));
                    jQuery(document).find('.edit-user').attr('href', 'users/edit?id=' + jQuery.trim(p));
                }
            }
            else {
                jQuery(document).find('.del-user').attr('href', '');
                jQuery(document).find('.edit-user').attr('href', '');
            }
        });
        jQuery('.check_all').click(function () {
            if (jQuery(this).prop('checked')) {
                jQuery('.check').prop('checked', true);
                jQuery(document).find('.del-user').attr('href', 'users/deleteAll');
            }
            else {
                jQuery('.check').prop('checked', false);
                jQuery(document).find('.del-user').attr('href', '');
            }
        });
        jQuery('.del-user').click(function () {
            k = 0;
            jQuery('.check').each(function () {
                if (jQuery(this).prop('checked')) {
                    k = 1;
                }
            })
            if (k == 1)
                confirm('Do you want to delete this user');
        });
    },
    deconnect: function () {
        if (jQuery('.deconnect').length > 0) {
            jQuery('.deconnect').on('click', function () {
                $id = jQuery(this).attr('data-mac');
                console.log($id);
                jQuery.ajax({
                    url: '/dashboard/deconnect',
                    type: 'post',
                    data: {id: $id},
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        }
    },
    controlAction: function () {
        if (jQuery('.editLink').length > 0) {
            jQuery('.editLink').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                //console.log(jQuery('.checked'));
                $item = 0;
                jQuery.each(jQuery('.checked'), function (index, item) {
                    if (jQuery(item).prop('checked')) {
                        console.log(jQuery(item).attr('value'));
                        $item = jQuery(item).attr('value');
                    }
                });
                if ($item == 0) {
                    alert('Please select a packet!!');
                } else {
                    $action = jQuery(this).attr('href') + '/' + $item;
                    //console.log($action);
                    jQuery('#adminForm').attr('action', $action);
                    jQuery('#adminForm').submit();
                }
            });
        }
        ;
        if (jQuery('.removeLink').length > 0) {
            jQuery('.removeLink').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                //console.log(jQuery('.checked'));
                $item = 0;
                jQuery.each(jQuery('.checked'), function (index, item) {
                    if (jQuery(item).prop('checked')) {
                        console.log(jQuery(item).attr('value'));
                        $item = jQuery(item).attr('value');
                    }
                });
                if ($item == 0) {
                    alert('Please select a packet!!');
                } else {
                    $action = jQuery(this).attr('href') + '/' + $item;
                    //console.log($action);
                    jQuery('#adminForm').attr('action', $action);
                    jQuery('#adminForm').submit();
                }
            });
        }
        ;
        if (jQuery('.linkCancel').length > 0) {
            jQuery('.linkCancel').on('click', function (e) {
                //console.log('ok');
                e.preventDefault();
                e.stopPropagation();
                $action = jQuery(this).attr('data-href');

                jQuery('form').attr('action', $action);
                jQuery('form').submit();
            });
        }
        ;



    },
};
jQuery(document).ready(function () {
    App.submit();
    App.checkUser();
    App.deconnect();
    App.controlAction();
});

