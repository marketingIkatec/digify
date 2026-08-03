document.addEventListener("DOMContentLoaded", () => {
  const content = document.getElementById("conteudo-blog");
  const indice = document.getElementById("indice");
  const box = document.getElementById("indiceBox");
  const toggle = document.getElementById("indiceToggle");

  if (!box || !indice) {
    return;
  }

  if (toggle) {
    const desktopQuery = window.matchMedia("(min-width: 992px)");

    const syncState = () => {
      box.classList.toggle("open", desktopQuery.matches);
      toggle.setAttribute("aria-expanded", String(box.classList.contains("open")));
    };

    syncState();

    toggle.addEventListener("click", () => {
      box.classList.toggle("open");
      toggle.setAttribute("aria-expanded", String(box.classList.contains("open")));
    });

    if (typeof desktopQuery.addEventListener === "function") {
      desktopQuery.addEventListener("change", syncState);
    }
  }

  if (!content) {
    return;
  }

  const headings = content.querySelectorAll("h2, h3");

  if (!headings.length) {
    box.classList.add("is-empty");
    return;
  }

  const entries = [];

  headings.forEach((heading, index) => {
    if (!heading.id) {
      heading.id = `secao-${index + 1}`;
    }

    const item = document.createElement("li");
    item.className = `blog-toc-item blog-toc-item--${heading.tagName.toLowerCase()}`;

    const button = document.createElement("button");
    button.type = "button";
    button.textContent = heading.textContent.trim();
    button.addEventListener("click", () => {
      heading.scrollIntoView({ behavior: "smooth", block: "start" });
      history.replaceState(null, "", `#${heading.id}`);
    });

    item.appendChild(button);
    indice.appendChild(item);
    entries.push({ heading, item });
  });

  const setActive = (id) => {
    entries.forEach(({ heading, item }) => {
      item.classList.toggle("is-active", heading.id === id);
    });
  };

  const updateActive = () => {
    const offset = window.scrollY + 180;
    let activeId = entries[0].heading.id;

    entries.forEach((entry, index) => {
      const top = entry.heading.getBoundingClientRect().top + window.scrollY;
      const nextTop = entries[index + 1]?.heading.getBoundingClientRect().top + window.scrollY;

      if (offset >= top && (!nextTop || offset < nextTop)) {
        activeId = entry.heading.id;
      }
    });

    setActive(activeId);
  };

  updateActive();
  window.addEventListener("scroll", updateActive, { passive: true });
  window.addEventListener("resize", updateActive);
});
