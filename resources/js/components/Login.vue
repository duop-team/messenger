<template>
    <div class="bg">
        <div class="content">
            <div class="card">
                <div class="card__title">Sign in</div>
                <div class="card__description">
                    <p>Please, enter your country, phone number or whatever they want from you</p>
                </div>
                <div class="card__form">
                    <form action="/login" method="post">
                        <div class="form__item">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="form__item">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form__footer">
                            <div class="form__error">
                                <img src="/images/error_icon.svg" class="error__img">
                                <div class="error__text">Warning! You did something wrong.</div>
                            </div>
                            <div class="form__submit">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login"
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR&family=Sarabun&family=Roboto+Condensed&display=swap');

.bg {
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    align-items: center;
    background-image: url(../../img/login_bg.svg), linear-gradient(67.6deg, #32C585 17.95%, #546286 97.28%);
    background-size: cover;
    position: relative;
}

.card {
    width: 480px;
    padding: 45px;
    background: #65B59E;
    mix-blend-mode: normal;
    border: 3px solid #FFC3C3;
    box-sizing: border-box;
    box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    color: #fff;
}

.card__title {
    font-family: Sarabun, sans-serif;
    font-size: 30px;
    text-align: center;
    color: #FFFFFF;
}

.card__description {
    margin-top: 15px;
    font-family: Sarabun, sans-serif;
    font-size: 18px;
}

.card__form input {
    padding: 3px 0;
    font-family: Noto Sans KR, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    width: 100%;
    background-color: transparent;
    border: 0;
    border-bottom: 1px solid #FFFFFF;;
    outline: 0;
    color: #fff;
    margin-top: 10px;
}

.card__form label {
    font-family: Sarabun, sans-serif;
    font-size: 18px;

}

.form__item {
    margin-top: 25px;
}

.form__footer {
    display: flex;
    flex-flow: row nowrap;
    margin-top: 45px;
}

.form__error {
    display: flex;
    flex-flow: row nowrap;
    color: #FF0B0B;
}

.error__img {
    height: 18px;
    margin-right: 10px;
}

.error__text {
    font-family: Roboto Condensed, sans-serif;
    font-size: 18px;
}

.form__submit button {
    background: linear-gradient(180deg, #E26363 0%, #DE796B 100%);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 32px;
    font-family: Sarabun, sans-serif;
    font-size: 16px;
    color: #fff;
    border: 0;
    outline: 0;
    padding: 13px 45px;
}
</style>
