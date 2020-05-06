const form = document.querySelector('[data-form]');
form.addEventListener('submit', loadLogin);

function loadLogin(event) {
  event.preventDefault();
  const dados = new FormData(form);
  const url = 'login.php';
  const body = {
    method: 'POST',
    body: dados
  };
  fetch(url, body)
    .then(response => response.json())
    .then(r => {
      if(r.key === 'error') {
        const spanError = document.querySelector('.error');
        spanError.innerText = r.msg;
        spanError.style.display = 'block';
        document.querySelector('.success').style.display = 'none';
      } else {
        const spanSuccess = document.querySelector('.success');
        spanSuccess.innerText = `Bem vindo ${r}`;
        spanSuccess.style.display = 'block';
        document.querySelector('.error').style.display = 'none';
      }
    });
}