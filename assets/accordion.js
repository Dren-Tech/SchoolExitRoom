const accordionLink = document.querySelectorAll('.accordionLink');

accordionLink.forEach((element, index) => {
    element.addEventListener('click', event => {
        const hintId = element.dataset.linkForAccordionContent;

        const accordionContent = document.querySelector('#' + hintId);

        accordionContent.classList.toggle('hidden');
        console.log(accordionContent);
        event.preventDefault();
    });
});