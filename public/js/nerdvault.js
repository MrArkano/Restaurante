document.addEventListener('DOMContentLoaded',function(){
 document.querySelectorAll('[data-confirm]').forEach(function(form){form.addEventListener('submit',function(e){if(!window.confirm(form.dataset.confirm)){e.preventDefault()}})});
 const file=document.querySelector('[data-image-preview]');const preview=document.querySelector('#image-preview');if(file&&preview){file.addEventListener('change',function(){const selected=file.files&&file.files[0];if(!selected)return;const img=document.createElement('img');img.className='preview-image';img.alt='Vista previa de la imagen seleccionada';img.src=URL.createObjectURL(selected);preview.replaceChildren(img)})}
 const card=document.querySelector('#card_number');if(card)card.addEventListener('input',function(){card.value=card.value.replace(/\\D/g,'').slice(0,16).replace(/(.{4})/g,'$1 ').trim()});
 const exp=document.querySelector('#card_expiration');if(exp)exp.addEventListener('input',function(){let value=exp.value.replace(/\\D/g,'').slice(0,4);if(value.length>2)value=value.slice(0,2)+'/'+value.slice(2);exp.value=value});
 const cvv=document.querySelector('#card_cvv');if(cvv)cvv.addEventListener('input',function(){cvv.value=cvv.value.replace(/\\D/g,'').slice(0,4)});
 document.querySelectorAll('.alert-dismissible').forEach(function(alert){setTimeout(function(){if(window.bootstrap)bootstrap.Alert.getOrCreateInstance(alert).close()},6000)});
 const checkout=document.querySelector('[data-checkout]');if(checkout)checkout.addEventListener('submit',function(){const button=checkout.querySelector('button[type=submit]');if(button){button.disabled=true;button.innerHTML='<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Procesando...'}});
});
