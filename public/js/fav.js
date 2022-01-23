export default function () {

    document.querySelector('.js-fav').addEventListener('click', onClickFav);

    function onClickFav(e) {

        e.preventDefault();

        const url = this.href;

        axios.get(url).then(function (response) {
            let star = e.target;
            if (star.classList.contains('far')) {
                star.classList.replace('far', 'fas');
            } else {
                star.classList.replace('fas', 'far');
            }

        })

    }

}
