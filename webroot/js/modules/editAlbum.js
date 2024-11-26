import { validateForm } from './validateForm.js';

export function showEditForm(id, name, year, artistId) {
    // Preencher os campos com os dados do álbum
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-year').value = year;
    document.getElementById('edit-artist-id').value = artistId;
    document.getElementById('edit-id').value = id;

    // Seleciona o formulário de edição
    var form = document.getElementById('edit-album-form');
    
    // Verificar se o formulário está visível
    if (form.classList.contains('show')) {
        // Remover a classe 'show' para iniciar a transição
        form.classList.remove('show');
        
        // Atraso para garantir que a transição aconteça antes de esconder
        setTimeout(() => {
            form.style.display = 'none';  // Defina como 'none' após a transição
        }, 500);  // Ajuste o tempo conforme a duração da transição (0.5s)
    } else {
        // Exibir o formulário
        form.style.display = 'block';
        
        // Adicionar a classe 'show' para iniciar a transição suave
        setTimeout(() => {
            form.classList.add('show');
        }, 10);  // Atraso para garantir que o 'display' seja alterado antes da animação
    }

    // Chama a função de validação dos campos de edição
    validateForm('edit-artist-id', 'edit-name', 'edit-year', 'save-changes-btn');
}

export function addEditEventListener() {
    // Adicionar o event listener para todos os botões "Edit"
    document.querySelectorAll('.edit-album-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Obter os dados do álbum dos atributos de dados do botão
            var id = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');
            var year = this.getAttribute('data-year');
            var artist = this.getAttribute('data-artist');

            // Chamar a função para exibir o formulário de edição com os dados do álbum
            showEditForm(id, name, year, artist);
        });
    });
}
