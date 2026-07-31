import 'flowbite';

import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener("DOMContentLoaded", () => {

    const toggleSearch = document.querySelector('#toggleSearch');
    if(toggleSearch){
        toggleSearch.addEventListener('click', () => {
            const box = document.getElementById('searchBox');
            box.classList.toggle('hidden');
        });
    }
    

    function formatLabel(key) {

        //key = key.charAt(0) + key.slice(1);
        switch (key) {
            case 'created_at_br' : key = 'Data de Cadastro'; break;
            case 'status_label'  : key = 'Status'; break;
        }

        return key
            .replace(/_/g, " ")        // troca _ por espaço
            .replace(/\b\w/g, c => c.toUpperCase()); // coloca a primeira letra de cada palavra em maiúscula
    }

    document.querySelectorAll('.verDetalhes').forEach(btn => {
        btn.addEventListener('click', () => {
            const dados = JSON.parse(btn.dataset.info);
            const container = document.getElementById('mCampos');

            // Limpa conteúdo antes de adicionar novamente
            container.innerHTML = '';

            Object.entries(dados).forEach(([key, value]) => {
                if (!value) value = '—';

                let label = formatLabel(key); 

                // Monta o elemento
                container.innerHTML += `
                    <p class="text-sm">
                        <strong>${label}:</strong> ${value}
                    </p>
                `;
            });

            document.getElementById('modalDetalhes').classList.remove('hidden');
        });
    });

    const fecharModal = document.querySelector('#fecharModal');
    if(fecharModal){
        fecharModal.addEventListener('click', () => {
            document.getElementById('modalDetalhes').classList.add('hidden');
        });
    }

    /* ====== ckeditor ====== */
    document.querySelectorAll('.ckeditor').forEach(editor => {  
        ClassicEditor.create(editor, {
            ckfinder: {
                uploadUrl: editor.dataset.uploadUrl
            }
        }).catch(error => console.error(error));
    });
    /* ====== ckeditor ====== */

    
    document.querySelectorAll('.mostraDetalhes').forEach(tr => {    
        tr.addEventListener('click', () => {
            const nextRow = tr.nextElementSibling;
            if(!nextRow) return;

            const collapseIcon = tr.querySelector('.fa-folder');
            if(collapseIcon){
                collapseIcon.classList.toggle('fa-folder-open');
            }

            const detalhe = nextRow.querySelector('.detalhes');
            if(!detalhe) return;

            detalhe.style.display = detalhe.style.display === 'block' ? 'none' : 'block';
        });
    });

    if(document.querySelectorAll('.input-selectize').length){
        $('.input-selectize').selectize({
            plugins: ['remove_button'],
            create: true, // permite criar novas opções
            persist: false,
            placeholder: 'Digite e pressione Enter...',
            delimiter: ','
        });
    }

    /* ====== slug url ====== */

    const slugInput    = document.querySelector('input[name="slug"]');
    const paginaSelect = document.querySelector('select[name="page_id"]');
    const localeSelect = document.querySelector('select[name="locale"]');
    const titleInputs  = document.querySelectorAll('.onloadUrl');

    if (!slugInput) return;

    /* ---------- Helpers ---------- */

    const getDatasetSlug = (select) => {
        if (!select) return null;

        const option = select.options[select.selectedIndex];
        const slug = option?.dataset?.slug;

        return slug && slug !== '0' ? slug : null;
    };

    const buildUrl = (title = '') => {
        const baseLocale = getDatasetSlug(localeSelect);
        const basePage   = getDatasetSlug(paginaSelect);
        const slug       = title ? slugify(title) : '';

        const parts = [];

        if (baseLocale) parts.push(baseLocale);
        if (basePage)   parts.push(basePage);
        if (slug)       parts.push(slug);

        return parts.join('/');
    };

    /* ---------- Events ---------- */

    // Normaliza slug digitado manualmente
    slugInput.addEventListener('blur', () => {
        slugInput.value = slugInput.value ? slugify(slugInput.value) : '';
    });

    // Mudança da página pai
    if (localeSelect) {
        localeSelect.addEventListener('change', () => {
            titleInputs.forEach(input => {
                if (input.value && slugInput.value == '') {
                    slugInput.value = buildUrl(input.value);
                }
            });
        });
    }

    // Mudança da página pai
    if (paginaSelect) {
        paginaSelect.addEventListener('change', () => {
            titleInputs.forEach(input => {
                if (input.value && slugInput.value == '') {
                    slugInput.value = buildUrl(input.value);
                }
            });
        });
    }

    // Blur nos campos que geram slug
    titleInputs.forEach(input => {
        input.addEventListener('blur', () => {
            if (!input.value) return;
            if(slugInput.value == ''){
                slugInput.value = buildUrl(input.value);
            }            
        });
    });

    /* ---------- Slugify ---------- */
    function slugify(text) {
        return text
            .toString()
            .normalize('NFD')                    // separa acentos
            .replace(/[\u0300-\u036f]/g, '')    // remove acentos
            .replace(/ç/gi, 'c')
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')               // espaços -> hífen
            .replace(/[^\w\-\/]+/g, '')         // remove caracteres especiais
            .replace(/\-\-+/g, '-');            // evita hífen duplo
    }
    /* ====== slug url ====== */


    /* ====== Meta Title, Meta Description ====== */
    const titleEquals  = document.querySelectorAll('.equalsMetaTitle');
    const descriptionEquals = document.querySelectorAll('.equalsMetaDescription');
    titleEquals.forEach(input => {
        input.addEventListener('blur', () => {
            const metaTitle = document.querySelector('input[name="meta_title"]');
            if(metaTitle && metaTitle.value == ''){
                metaTitle.value = input.value;
            }
        });
    });
    descriptionEquals.forEach(input => {
        input.addEventListener('blur', () => {
            const metaDescription = document.querySelector('textarea[name="meta_description"]');
            if(metaDescription && metaDescription.value == ''){
                metaDescription.value = input.value;
            }
        });
    });
    /* ====== Meta Title, Meta Description ====== */

    /* ====== Upload de Imagens ====== */
    document.querySelectorAll('.image-upload').forEach(component => {
        const uploadBtn = component.querySelector('.btn-upload');
        const fileInput = component.querySelector('.upload-input');
        const previewArea = component.querySelector('.preview-area');
        const form = component.querySelector('.image-upload-form');

        // Abrir seletor ao clicar no botão
        uploadBtn.addEventListener('click', () => {
            fileInput.click();
        });

        // Quando selecionar o arquivo
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];

            if (!file) return;

            // Garantir que é imagem
            if (!file.type.startsWith('image/')) {
                alert("Apenas imagens são permitidas!");
                fileInput.value = "";
                return;
            }         
            
            if(form){
                // Auto-submit do formulário
                setTimeout(() => {
                    form.submit();
                }, 1000); // pequeno delay para exibir o preview antes de enviar
            }else{
                // Preview
                const reader = new FileReader();
                reader.onload = e => {
                    previewArea.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid">
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    });
    /* ====== Upload de Imagens ====== */

    /*toggle status(ativo e inativo)*/
    const toggle = document.getElementById("statusToggle");
    if(toggle){
        const statusInput = document.getElementById("status");
        toggle.addEventListener("change", function () {
            statusInput.value = this.checked ? 1 : 0;
        });
    }
    /*toggle status(ativo e inativo)*/



    document.querySelectorAll('.js-toggle-icon').forEach(toggle => {
        toggle.addEventListener('click', () => {

            const container = toggle.closest('.toggle-container');
            if (!container) return;

            const content = container.querySelector('.js-toggle-content');
            if (!content) return;

            toggle.classList.toggle('is-open');
            content.classList.toggle('is-open');

        });
    });
});

/* ====== SweetAlert2 com Livewire ====== */
document.addEventListener('livewire:init', () => {

    Livewire.on('swal:confirm', ({ id, text, name }) => {
        Swal.fire({
            title: 'Deseja realmente '+text+'?',
            text: name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Sim, '+text
        }).then(result => {
            if (result.isConfirmed) {
                Livewire.find(id).call('toggleConfirmed');
            }
        });
    });

    Livewire.on('swal-alert', ({icon, text}) => {
        Swal.fire({
            icon: icon,
            title: text,
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
        });
    });

    Livewire.on('swal:delete-confirm', ({ id, text }) => {
        Swal.fire({
            title: 'Deseja realmente excluir <b>'+text+'</b>?',
            text: 'Essa ação é irreversível!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
        }).then(result => {
            if (result.isConfirmed) {
                Livewire.find(id).call('deleteConfirmed');
            }
        });
    });

    Livewire.on('row-deleted', ({ id }) => {
        document.getElementById('row-' + id)?.remove();
        document.getElementById('detalhes-row-' + id)?.remove();
    });
});
/* ====== SweetAlert2 com Livewire ====== */
