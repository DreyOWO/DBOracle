try{
    
    $(document).ready(function () {
        
        console.log("Is Ready");
       
    });

    var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
	    
    function Toast(title,icon){
        toastMixin.fire({
        animation: true,
        title: title,
        icon:icon
        });    


    }
    
    function WaitingDialog(mensaje) {
        return Swal.fire({
            title: mensaje, didOpen: () => { Swal.showLoading() }, allowOutsideClick: false,
            allowEscapeKey: false });
    }
    
    function goCalendar(){
        window.location.assign("/calendar");
    }
    function goHome(){
        window.location.assign("/home");
    }
    
    function goBilling(){
        window.location.assign("/facturas");
    }
    
    function close(){
        window.location.assign("/");
    }
    
    function closeSession(){
        messageAsk("Cerrar Sesión","¿Está seguro que desea cerrar la sesión?","question",close)
        
    }
    
    
    function messageAsk(title,message,type,callbackFunc){
        Swal.fire({
            title: title,
            text: message,
            icon: type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
            }).then((result) => {
            if (result.isConfirmed) {
              callbackFunc();
            }
          });
    }       

}

catch(e){
    console.log("Ocurrió un error general: " + e);
}
