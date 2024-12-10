const faqItems = document.querySelectorAll('.faq_question1, .faq_question2');

faqItems.forEach(item => {
    item.addEventListener('click', () => {
        const answer = item.nextElementSibling;

        item.classList.toggle('active');
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});