import Swal from 'sweetalert2';
let timerInterval: number | undefined;

export const languageSettings = {
    "sEmptyTable": "Nenhum dado disponível na tabela",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sSearch": "Pesquisar:",
    "sZeroRecords": "Nenhum registro encontrado",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": ativar para classificar a coluna em ordem crescente",
        "sSortDescending": ": ativar para classificar a coluna em ordem decrescente"
    }
};

export function  swalLoad() {
    timerInterval
    Swal.fire({
    title: "Atenção!",
    html: "Aguarde, em estantes os dados seram exibidos!",
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
        timer.textContent = `${Swal.getTimerLeft()}`;
        }, 100);
    },
    willClose: () => {
        clearInterval(timerInterval);
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
  }
});
}