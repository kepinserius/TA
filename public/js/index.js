const flash = document.querySelector('#flash-data-success');

const alert = Swal.mixin({
    toast: true,
    position: 'top-end',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500,
});

if (flash.getAttribute('data-flash-success') !== '') {
    alert.fire({
        icon: 'success',
        title: `${flash.getAttribute('data-flash-success')}`,
    });
}
const alerterror = Swal.mixin({
    toast: true,
    position: 'top-end',
    icon: 'error',
    showConfirmButton: false,
    timer: 1500,
});

const errorflash = document.querySelector('#flash-data-error');

if (errorflash.getAttribute('data-flash-error') !== '') {
    alerterror.fire({
        icon: 'error',
        title: `${errorflash.getAttribute('data-flash-error')}`,
    });
}