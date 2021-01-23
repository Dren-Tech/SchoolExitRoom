const accordionLink = document.querySelectorAll('.hint-accordion');

accordionLink.forEach((element, index) => {
    element.addEventListener('click', event => {
        const hintId = element.dataset.linkForHint;

        const hintTextBox = document.querySelector('#' + hintId);

        hintTextBox.classList.toggle('hidden');
        console.log(hintTextBox);
        event.preventDefault();
    });
});