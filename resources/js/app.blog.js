document.addEventListener("DOMContentLoaded", function () {

    const content = document.querySelectorAll("#conteudo-blog h2");
    const indice = document.getElementById("indice");
    const box = document.getElementById("indiceBox");

    /* --- Gerar índice automático --- */
    content.forEach((h2, i) => {
        const id = "secao-" + i;
        h2.setAttribute("id", id);

        const titulo = h2.textContent.trim();

        const li = document.createElement("li");
        li.textContent = titulo;

        li.addEventListener("click", () => {
            document.getElementById(id).scrollIntoView({ behavior: "smooth" });

            document.querySelectorAll(".indice-li li")
                .forEach(el => el.classList.remove("active"));

            li.classList.add("active");
        });

        indice.appendChild(li);
    });


    /* --- Toggle com animação (mobile e desktop) --- */
    function toggleIndice() {
        box.classList.toggle("open");
    }

    if (window.innerWidth >= 992) {
        toggleIndice();   // desktop: abre
    }

    document.getElementById("indiceToggle").addEventListener("click", toggleIndice);

    document.getElementById("indiceDesktopToggle").addEventListener("click", toggleIndice);



    /* --- Scroll Spy do índice --- */
    window.addEventListener("scroll", () => {
        let scrollPosition = window.scrollY + 200;

        content.forEach((h2, index) => {
            const top = h2.offsetTop;
            const next = content[index + 1]?.offsetTop;

            if (scrollPosition >= top && (!next || scrollPosition < next)) {
                document.querySelectorAll(".indice-li li")
                    .forEach(li => li.classList.remove("active"));

                indice.children[index].classList.add("active");
            }
        });
    });

    /* --- Fechar índice ao chegar na seção #blogs --- */
  const blogsSection = document.getElementById("posts-relacionados");

  window.addEventListener("scroll", () => {
      if (!blogsSection) return;

      const blogsTop = blogsSection.offsetTop;
      const scrollY = window.scrollY + window.innerHeight / 3;

      if (scrollY >= blogsTop) {
          box.classList.remove("open"); // fecha com animação
      }
  });

});
