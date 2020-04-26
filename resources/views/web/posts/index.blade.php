@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
@endphp
@extends('layouts.web')

@section('page_title', 'Objave')

@section('content')
    <div class="container">
        <section class="hero">
            <div class="hero__info">
                <h1 class="hero__title">Ostani kod kuće.</h1>
                <p class="hero__text">Izazovne situacije zahtevaju korisne informacije. #OstaniKodKuće i ostani u toku sa trenutnim dešavanjima, ili objavi novu informaciju iz neke od kategorija koristeći formu.</p>
            </div>
            <div class="hero__image">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 482.8 341.8"><path d="M-63.7-122.5h612V404h-612z" class="st0"/><path d="M421.2 280.9v-32.8c-3.4 2.3-5 6.2-4.7 11.7v17.6c1.9.8 3.5 2 4.7 3.5M328.5 287.5h92.4v4.1h-92.4zM303.9 82.3h154V87h-154z" class="st1"/><path d="M58.5 84.2h6.3L108.3 337H4.4L38.3 84zM185.6 216.1h25.1l-40.5-50.2-33.6-41.7-25 12.3v1.2l11.6 103.7 3.4-.7 3-.2.8-16.6 2-3.5 4.8-3.5 4.7-.8zM121.5 42.1l130.6 174.2 171.5-.2 10.5 4.5 1.7 19.9 8.5 1.9 5 5.2.4 8.7v69.9H334.5l8.1 10.8h136.5l-.2-174.7-184.8-80-154.3-66.9z" class="st2"/><path fill="#fff" fill-rule="evenodd" d="M123.2 241.4l10.7 95.6h174.4l-98.6-122-67.8 1.1-8.6 3.7-2.9 4.1-.8 16.6z" clip-rule="evenodd"/><path d="M143.6 280.9v-32.8c3.4 2.3 5 6.2 4.7 11.7v17.6c-1.9.8-3.4 2-4.7 3.5M143.9 287.5h92.4v4.1h-92.4z" class="st4"/><path fill="#89c5e5" fill-rule="evenodd" d="M132.7 326.2h9.9l.3 10.8h165.4l-8.7-10.8z" clip-rule="evenodd"/><path d="M22.7 338.6c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h458.4c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6H22.7zM1.6 338.6c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h9.6c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6H1.6z" class="st6"/><path d="M421.2 326.2h17.6V337h-17.6z" class="st0"/><path d="M141 327.9h-14.3v7.5H141v-7.5zm-15.9-3.3h17.6c.9 0 1.6.7 1.6 1.6V337c0 .9-.7 1.6-1.6 1.6h-17.6c-.9 0-1.6-.7-1.6-1.6v-10.8c0-.8.7-1.6 1.6-1.6z"/><path d="M448.1 293.2H117v31.4h331.1v-31.4zM115.4 290h334.4c.9 0 1.6.7 1.6 1.6v34.7c0 .9-.7 1.6-1.6 1.6H115.4c-.9 0-1.6-.7-1.6-1.6v-34.7c-.1-.9.7-1.6 1.6-1.6z"/><path d="M117 291.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-41.3c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v41.3z"/><path d="M145.5 291.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-41.3c0-3.8-3.2-6.3-7.2-7.5-1.7-.5-3.6-.7-5.4-.7-1.9 0-3.7.2-5.4.7-4.1 1.1-7.3 3.6-7.3 7.5 0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-5.6 4.2-9.1 9.6-10.6 2-.5 4.1-.8 6.3-.8 2.1 0 4.3.3 6.3.8 5.4 1.5 9.6 5 9.6 10.6v41.3zM422.8 291.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-41.3c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v41.3z"/><path d="M451.4 291.6c0 .9-.7 1.6-1.6 1.6s-1.6-.7-1.6-1.6v-41.3c0-3.8-3.2-6.3-7.2-7.5-1.7-.5-3.6-.7-5.4-.7-1.9 0-3.7.2-5.4.7-4.1 1.1-7.3 3.6-7.3 7.5 0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-5.6 4.2-9.1 9.6-10.6 2-.5 4.1-.8 6.3-.8 2.1 0 4.3.3 6.3.8 5.4 1.5 9.6 5 9.6 10.6v41.3zM131.3 240.5c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-12.1-.1c0-1.8.3-3.6 1-5.2.7-1.7 1.7-3.3 3-4.6 1.3-1.3 2.9-2.3 4.6-3 1.7-.7 3.5-1 5.4-1 .9 0 1.6.8 1.6 1.7 0 .9-.8 1.6-1.7 1.6-1.4 0-2.8.2-4.1.7-1.3.5-2.5 1.3-3.5 2.3-1 1-1.8 2.2-2.3 3.5-.5 1.3-.8 2.6-.7 4v12.2z"/><path d="M437.5 240.5c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-12.1-.2c0-1.4-.2-2.7-.7-4-.5-1.3-1.3-2.5-2.3-3.5-1-1-2.2-1.8-3.5-2.3-1.3-.5-2.7-.8-4.1-.7H141.9c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h281.6c1.8 0 3.7.3 5.3 1 1.7.7 3.3 1.7 4.6 3 1.3 1.3 2.3 2.9 3 4.6.7 1.7 1 3.4 1 5.2v12.2z"/><path d="M234.7 216.1c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v75.5c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-75.5zM327.2 216.1c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v75.5c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-75.5zM145.5 283.3c0 .9-.7 1.6-1.5 1.7-.9 0-1.6-.7-1.7-1.5v-.4c0-2.1.9-3.9 2.2-5.3 1.3-1.3 3.2-2.2 5.2-2.3H193.4c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6h-43.5c-1.2.1-2.3.6-3.1 1.3-.8.8-1.3 1.8-1.3 3v.3"/><path d="M237.9 283.5c0 .9-.8 1.6-1.7 1.5-.9 0-1.6-.8-1.5-1.7v-.2c0-1.2-.5-2.2-1.3-3-.8-.8-1.9-1.3-3.1-1.3H186.7c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6H230.4c2 .1 3.9.9 5.2 2.3 1.4 1.4 2.2 3.2 2.2 5.3.1.1.1.2.1.3"/><path d="M237.9 283.3c0 .9-.7 1.6-1.5 1.7-.9 0-1.6-.7-1.7-1.5v-.4c0-2.1.9-3.9 2.2-5.3 1.3-1.3 3.2-2.2 5.2-2.3H285.8c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6h-43.5c-1.2.1-2.3.6-3.1 1.3-.8.8-1.3 1.8-1.3 3v.3"/><path d="M330.4 283.5c0 .9-.8 1.6-1.7 1.5-.9 0-1.6-.8-1.5-1.7v-.2c0-1.2-.5-2.2-1.3-3-.8-.8-1.9-1.3-3.1-1.3h-43.5c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6H323c2 .1 3.9.9 5.2 2.3 1.4 1.4 2.2 3.2 2.2 5.3v.3"/><path d="M330.4 283.3c0 .9-.7 1.6-1.5 1.7-.9 0-1.6-.7-1.7-1.5v-.4c0-2.1.9-3.9 2.2-5.3 1.3-1.3 3.2-2.2 5.2-2.3H378.3c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6H334.7c-1.2.1-2.3.6-3.1 1.3-.8.8-1.3 1.8-1.3 3 .1.2.1.2.1.3"/><path d="M422.8 283.5c0 .9-.8 1.6-1.7 1.5-.9 0-1.6-.8-1.5-1.7v-.2c0-1.2-.5-2.2-1.3-3-.8-.8-1.9-1.3-3.1-1.3H371.6c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6H415.3c2 .1 3.9.9 5.2 2.3 1.4 1.4 2.2 3.2 2.2 5.3.1.1.1.2.1.3M421.2 324.6h17.6c.9 0 1.6.7 1.6 1.6V337c0 .9-.7 1.6-1.6 1.6h-17.6c-.9 0-1.6-.7-1.6-1.6v-10.8c0-.8.7-1.6 1.6-1.6m15.9 3.3h-14.3v7.5h14.3v-7.5z"/><path d="M295.8 216.1c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V72.8c0-.9.7-1.6 1.6-1.6h172.5c.9 0 1.6.7 1.6 1.6V337c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V74.4H295.8v141.7z"/><path d="M456.3 84.5H304.9V140h151.4V84.5zm-153-3.3h154.6c.9 0 1.6.7 1.6 1.6v58.8c0 .9-.7 1.6-1.6 1.6H303.3c-.9 0-1.6-.7-1.6-1.6V82.8c0-.9.7-1.6 1.6-1.6zM456.3 153.3H304.9v55.6h151.4v-55.6zm-153-3.2h154.6c.9 0 1.6.7 1.6 1.6v58.8c0 .9-.7 1.6-1.6 1.6H303.3c-.9 0-1.6-.7-1.6-1.6v-58.8c0-.9.7-1.6 1.6-1.6zM449.7 281.1c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h6.5v-55.6H434c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h23.8c.9 0 1.6.7 1.6 1.6v58.8c0 .9-.7 1.6-1.6 1.6h-8.1z"/><path d="M341 143.3h-20.4c-.9 0-1.6-.7-1.6-1.6V116c0-.9.7-1.6 1.6-1.6H341c.9 0 1.6.7 1.6 1.6v25.6c0 1-.7 1.7-1.6 1.7m-18.8-3.3h17.1v-22.4h-17.1V140z"/><path d="M327 115.8c.1.9-.5 1.7-1.4 1.8-.9.1-1.7-.5-1.8-1.4l-2.3-17.9c-.1-.9.5-1.7 1.4-1.8.9-.1 1.7.5 1.8 1.4l2.3 17.9zM332.4 115.9c.1.9-.6 1.7-1.5 1.8-.9.1-1.7-.6-1.8-1.5l-1.4-15.1c-.1-.9.6-1.7 1.5-1.8.9-.1 1.7.6 1.8 1.5l1.4 15.1zM338.2 116.2c-.1.9-.9 1.5-1.8 1.4-.9-.1-1.5-.9-1.4-1.8l1.3-13c.1-.9.9-1.5 1.8-1.4.9.1 1.5.9 1.4 1.8l-1.3 13zM429.9 141.7c0 .9-.7 1.6-1.6 1.6s-1.6-.7-1.6-1.6V96.3c0-.9.7-1.6 1.6-1.6h11.4c.9 0 1.6.7 1.6 1.6v45.3c0 .9-.7 1.6-1.6 1.6s-1.6-.7-1.6-1.6V98h-8.2v43.7z"/><path d="M420.7 141.7c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V102c0-.9.7-1.6 1.6-1.6h9c.9 0 1.6.7 1.6 1.6v39.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-38h-5.8v38.1z"/><path d="M407.1 141.7c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V92.3c0-.9.7-1.6 1.6-1.6h13.6c.9 0 1.6.7 1.6 1.6v49.4c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V93.9h-10.4v47.8z"/><path d="M389.5 141.1c-.1.9-1 1.5-1.8 1.3-.9-.1-1.5-1-1.3-1.8l6.9-43.4c.1-.9.9-1.5 1.8-1.3L404 97c.9.1 1.5.9 1.4 1.8l-6.9 43.1c-.1.9-1 1.5-1.8 1.3-.9-.1-1.5-1-1.3-1.8L402 100l-5.7-.8-6.8 41.9zM405.5 135c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h13.6c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-13.6zM405.5 130.4c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h13.6c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-13.6zM420.8 112.1c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6h7.3c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6h-7.3zM328 212.2h-15.2c-.9 0-1.6-.7-1.6-1.6v-45.8c0-.9.7-1.6 1.6-1.6H328c.9 0 1.6.7 1.6 1.6v45.8c.1.8-.7 1.6-1.6 1.6m-13.6-3.3h12v-42.6h-12v42.6z"/><path d="M312.8 198c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6H328c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-15.2z"/><path d="M320.4 206.2c1.5 0 2.7-1.2 2.7-2.7 0-1.5-1.2-2.7-2.7-2.7s-2.7 1.2-2.7 2.7c0 1.5 1.2 2.7 2.7 2.7" class="st7"/><path d="M448.4 212.2h-15.2c-.9 0-1.6-.7-1.6-1.6v-45.8c0-.9.7-1.6 1.6-1.6h15.2c.9 0 1.6.7 1.6 1.6v45.8c0 .8-.7 1.6-1.6 1.6m-13.7-3.3h12v-42.6h-12v42.6z"/><path d="M433.1 198c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h15.2c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-15.2z"/><path d="M440.7 206.2c1.5 0 2.7-1.2 2.7-2.7 0-1.5-1.2-2.7-2.7-2.7s-2.7 1.2-2.7 2.7c0 1.5 1.3 2.7 2.7 2.7" class="st7"/><path d="M33.3 294.2c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-15.6 12.6-22.6 25.6-29.7 10.6-5.9 21.5-11.9 24.8-22.8.3-.9 1.2-1.3 2-1.1.9.3 1.3 1.2 1.1 2-3.7 12.2-15.1 18.5-26.3 24.7-12.2 6.6-24 13.2-24 26.9" class="st8"/><path d="M24.7 287.3c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6h13.9c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6H24.7z" class="st8"/><path d="M38.6 287.3c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6c1 0 1.9.4 2.6 1.1.7.7 1.1 1.6 1.1 2.6 0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-.1 0-.2-.1-.3-.2-.1-.3-.2-.4-.2" class="st8"/><path d="M39 287.7c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v13.9c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-13.9z" class="st8"/><path d="M39 301.6c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6 0 1-.4 1.9-1.1 2.6-.7.7-1.6 1.1-2.6 1.1-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6.1 0 .2 0 .3-.1.2-.2.2-.3.2-.4" class="st8"/><path d="M38.6 302c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6H24.7c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h13.9z" class="st8"/><path d="M24.7 302c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6-1 0-1.9-.4-2.6-1.1-.7-.7-1.1-1.6-1.1-2.6 0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6 0 .1 0 .2.1.3.2.1.3.2.4.2" class="st8"/><path d="M24.3 301.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-13.9c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v13.9z" class="st8"/><path d="M24.3 287.7c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-1 .4-1.9 1.1-2.6l.1-.1c.6-.6 1.5-1 2.5-1 .9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6c-.1 0-.2 0-.3.1-.1.2-.2.3-.2.4M31.7 291.8c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6 1.7 0 3.2.7 4.3 1.8 1.1 1.1 1.8 2.6 1.8 4.3 0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-.8-.3-1.5-.8-2-.6-.6-1.4-.9-2.1-.9" class="st8"/><path d="M34.5 294.6c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6 0 1.7-.7 3.2-1.8 4.3-1.1 1.1-2.6 1.8-4.3 1.8-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6c.8 0 1.5-.3 2-.8.6-.6.9-1.3.9-2.1" class="st8"/><path d="M31.7 297.5c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6c-1.7 0-3.2-.7-4.3-1.8-1.1-1.1-1.8-2.6-1.8-4.3 0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6 0 .8.3 1.5.8 2 .6.6 1.3.9 2.1.9" class="st8"/><path d="M28.8 294.6c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6 0-1.7.7-3.2 1.8-4.3 1.1-1.1 2.6-1.8 4.3-1.8.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6-.8 0-1.5.3-2 .8-.6.6-.9 1.4-.9 2.1" class="st8"/><path d="M419.1 176.6h-77v13.6h77v-13.6zm-78.6-3.2h80.2c.9 0 1.6.7 1.6 1.6v16.8c0 .9-.7 1.6-1.6 1.6h-80.2c-.9 0-1.6-.7-1.6-1.6V175c0-.9.7-1.6 1.6-1.6z"/><path d="M372 187.1c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V180c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v7.1zM377.5 187.1c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V180c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v7.1z"/><path d="M391.1 178.8c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8-1.8-.8-1.8-1.8c-.1-1 .8-1.8 1.8-1.8M383.9 178.8c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8-1.8-.8-1.8-1.8.9-1.8 1.8-1.8M391.1 184.7c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8-1.8-.8-1.8-1.8c-.1-1 .8-1.8 1.8-1.8M383.9 184.7c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8-1.8-.8-1.8-1.8.9-1.8 1.8-1.8" class="st7"/><path d="M415.6 177.9c.3 0 .5.2.5.5s-.2.5-.5.5h-4.8c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h4.8zM407.3 179c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h1.4c.3 0 .5.2.5.5s-.2.5-.5.5h-1.4zM402.9 183c-.4-.4-1-.6-1.6-.6-.6 0-1.2.2-1.6.6-.4.4-.6 1-.6 1.6 0 .6.2 1.2.6 1.6.4.4 1 .6 1.6.6.6 0 1.2-.2 1.6-.6.4-.4.6-1 .6-1.6 0-.7-.2-1.2-.6-1.6m-1.6-2.8c1.2 0 2.3.5 3.1 1.3.8.8 1.3 1.9 1.3 3.1 0 1.2-.5 2.3-1.3 3.1-.8.8-1.9 1.3-3.1 1.3-1.2 0-2.3-.5-3.1-1.3-.8-.8-1.3-1.9-1.3-3.1 0-1.2.5-2.3 1.3-3.1.8-.8 1.9-1.3 3.1-1.3zM413.6 183c-.4-.4-1-.6-1.6-.6s-1.2.2-1.6.6c-.4.4-.6 1-.6 1.6 0 .6.2 1.2.6 1.6.4.4 1 .6 1.6.6s1.2-.2 1.6-.6c.4-.4.6-1 .6-1.6 0-.7-.2-1.2-.6-1.6m-1.6-2.8c1.2 0 2.3.5 3.1 1.3.8.8 1.3 1.9 1.3 3.1 0 1.2-.5 2.3-1.3 3.1-.8.8-1.9 1.3-3.1 1.3s-2.3-.5-3.1-1.3c-.8-.8-1.3-1.9-1.3-3.1 0-1.2.5-2.3 1.3-3.1.8-.8 1.9-1.3 3.1-1.3z"/><path d="M400.3 181.3c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v3.2c0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1v-3.2zM365 187.1c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-5.5h-15.5c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h17.2c.9 0 1.6.7 1.6 1.6v7.1z"/><path d="M344.6 180c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v5.5h15.5c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6h-17.2c-.9 0-1.6-.7-1.6-1.6V180zM411 181.3c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v3.2c0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1v-3.2zM350.1 193.5h-2.7v.4h2.7v-.4zm-4.3-3.3h5.9c.9 0 1.6.7 1.6 1.6v3.7c0 .9-.7 1.6-1.6 1.6h-5.9c-.9 0-1.6-.7-1.6-1.6v-3.7c0-.9.7-1.6 1.6-1.6zM413.7 193.5H411v.4h2.7v-.4zm-4.3-3.3h5.9c.9 0 1.6.7 1.6 1.6v3.7c0 .9-.7 1.6-1.6 1.6h-5.9c-.9 0-1.6-.7-1.6-1.6v-3.7c0-.9.8-1.6 1.6-1.6z"/><path d="M423.9 198h-86.6v10.9h86.6V198zm-88.3-3.2h89.9c.9 0 1.6.7 1.6 1.6v14.1c0 .9-.7 1.6-1.6 1.6h-89.9c-.9 0-1.6-.7-1.6-1.6v-14.1c0-.9.7-1.6 1.6-1.6zM84.1 328.8c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6V4.8c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v324z"/><path d="M82.8 19.5c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h4.4c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-4.4z"/><path d="M85.9 13.3c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v9.2c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-9.2z"/><path d="M87.9 17.5c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h11.4c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6H87.9z"/><path d="M106.7 28.3c.8.5 1 1.5.5 2.2-.5.8-1.5 1-2.2.5-2.4-1.5-4.3-3.5-5.5-5.9-1.3-2.4-1.9-5.1-1.7-7.9.2-2.8 1.1-5.4 2.6-7.7 1.5-2.2 3.6-4.1 6.1-5.3 2.5-1.2 5.3-1.7 8-1.4 2.7.3 5.3 1.2 7.6 2.9.7.5.9 1.5.4 2.3-.5.7-1.5.9-2.3.4-1.8-1.3-3.9-2.1-6-2.3-2.1-.2-4.3.2-6.3 1.1-2 .9-3.7 2.4-4.8 4.2-1.2 1.8-1.9 3.9-2 6.1-.1 2.2.4 4.4 1.3 6.2.9 1.8 2.4 3.4 4.3 4.6"/><path d="M120.1 8.3c-.7-.5-.9-1.5-.4-2.2.5-.7 1.5-.9 2.2-.4l12.6 8.5c.7.5.9 1.5.4 2.2L119.8 39c-.5.7-1.5.9-2.2.4L105 31c-.7-.5-.9-1.5-.4-2.2.5-.7 1.5-.9 2.2-.4L118 36l13.5-20-11.4-7.7zM101.8 8.5c.7.5.9 1.5.4 2.2-.5.7-1.5.9-2.2.4l-2.2-1.5c-.7-.5-.9-1.5-.4-2.2s1.5-.9 2.2-.4l2.2 1.5z"/><path d="M135 16.3L119.7 39l1.3.9 15.3-22.7-1.3-.9zm-18.8 22.3l17.1-25.4c.5-.7 1.5-.9 2.2-.4l4 2.7c.7.5.9 1.5.4 2.2L122.8 43c-.5.7-1.5.9-2.2.4l-4-2.7c-.7-.4-.9-1.4-.4-2.1zM82.8 117c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h4.4c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-4.4z"/><path d="M85.9 110.8c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v9.2c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-9.2z"/><path d="M87.9 115c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6h11.4c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6H87.9z"/><path d="M103.3 118.3c.4.8.1 1.8-.7 2.2-.8.4-1.8.1-2.2-.7-1.3-2.5-1.9-5.2-1.8-7.9.1-2.7.9-5.4 2.5-7.7 1.5-2.3 3.6-4.2 6.1-5.4 2.4-1.2 5.2-1.7 8-1.5 2.8.2 5.4 1.2 7.6 2.8 2.2 1.6 4 3.7 5.1 6.3.4.8 0 1.8-.8 2.1-.8.4-1.8 0-2.1-.8-.9-2-2.3-3.7-4-5-1.7-1.2-3.8-2-6-2.2-2.2-.2-4.4.2-6.3 1.2-1.9.9-3.6 2.4-4.8 4.2-1.2 1.9-1.9 4-2 6.1-.1 2.2.4 4.4 1.4 6.3"/><path d="M124.9 107.7c-.4-.8-.1-1.8.7-2.2.8-.4 1.8-.1 2.2.7l6.7 13.7c.4.8.1 1.8-.7 2.2l-24.5 12c-.8.4-1.8.1-2.2-.7l-6.7-13.6c-.4-.8-.1-1.8.7-2.2.8-.4 1.8-.1 2.2.7l5.9 12.1 21.7-10.6-6-12.1zM109 98.8c.4.8.1 1.8-.7 2.2-.8.4-1.8.1-2.2-.7l-1.2-2.4c-.4-.8-.1-1.8.7-2.2.8-.4 1.8-.1 2.2.7l1.2 2.4z"/><path d="M133.8 122.1l-24.6 12 .7 1.4 24.6-12-.7-1.4zm-27.4 9.9l27.5-13.4c.8-.4 1.8-.1 2.2.7l2.1 4.3c.4.8.1 1.8-.7 2.2L110 139.2c-.8.4-1.8.1-2.2-.7l-2.1-4.3c-.5-.9-.1-1.9.7-2.2zM81.8 64.7c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6h-4.4c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h4.4z"/><path d="M75.4 61.7c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6V71c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-9.3z"/><path d="M76.7 62.7c.9 0 1.6.7 1.6 1.6 0 .9-.7 1.6-1.6 1.6H65.3c-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6h11.4z"/><path d="M66.9 64.4c0 .9-.8 1.6-1.7 1.5-.9 0-1.6-.8-1.5-1.7.1-2.2-.4-4.4-1.4-6.2-1-1.9-2.5-3.5-4.4-4.6-1.9-1.1-4-1.7-6.1-1.7-2.1 0-4.3.5-6.2 1.7-1.9 1.1-3.4 2.7-4.5 4.6-1 1.9-1.6 4-1.5 6.2 0 .9-.7 1.6-1.6 1.7-.9 0-1.6-.7-1.7-1.6-.1-2.8.6-5.5 1.9-7.9 1.3-2.4 3.2-4.4 5.7-5.8 2.4-1.4 5.1-2.1 7.8-2.1s5.4.8 7.8 2.2c2.4 1.4 4.3 3.5 5.6 5.9 1.3 2.3 1.9 5 1.8 7.8"/><path d="M36.4 64c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6l-.1 13.6 24.1.2.1-13.5c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6l-.1 15.1c0 .9-.7 1.6-1.6 1.6l-27.3-.2c-.9 0-1.6-.7-1.6-1.6l.1-15.2zM53.4 49.1c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-2.7c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6v2.7z"/><path d="M36.2 77.6l30.6.2c.9 0 1.6.7 1.6 1.6v4.8c0 .9-.7 1.6-1.6 1.6l-30.6-.2c-.9 0-1.6-.7-1.6-1.6v-4.8c0-.9.7-1.6 1.6-1.6m29 3.5l-27.4-.2v1.5l27.4.2v-1.5zM101.6 338.6H63.5c-.9 0-1.6-.7-1.6-1.6v-8.2c0-.9.7-1.6 1.6-1.6h38.1c.9 0 1.6.7 1.6 1.6v8.2c0 .9-.7 1.6-1.6 1.6m-36.5-3.2h34.8v-4.9H65.1v4.9zM292.5 326.2c0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6V337c0 .9-.7 1.6-1.6 1.6-.9 0-1.6-.7-1.6-1.6v-10.8z"/></svg>
            </div>
        </section>

        <section>
            <h2 class="heading-line">Kategorije</h2>
            <div class="category-grid">
                <a href="{{ route('homepage') }}#rezultati" class="category-grid__item">
                    <span>Sve Kategorije</span>
                    <span class="category-grid__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 32 32">
                            <path d="M25.7814076,5 C26.4544176,5 27,5.5466473 27,6.21859239 L27,13.5591854 C27,14.2321954 26.4533527,14.7777778 25.7814076,14.7777778 L18.4408146,14.7777778 C17.7678046,14.7777778 17.2222222,14.2311305 17.2222222,13.5591854 L17.2222222,6.21859239 C17.2222222,5.5455824 17.7688695,5 18.4408146,5 L25.7814076,5 Z M24.5555556,7.44444444 L19.6666667,7.44444444 L19.6666667,12.3333333 L24.5555556,12.3333333 L24.5555556,7.44444444 Z M13.5591854,5 C14.2321954,5 14.7777778,5.5466473 14.7777778,6.21859239 L14.7777778,13.5591854 C14.7777778,14.2321954 14.2311305,14.7777778 13.5591854,14.7777778 L6.21859239,14.7777778 C5.5455824,14.7777778 5,14.2311305 5,13.5591854 L5,6.21859239 C5,5.5455824 5.5466473,5 6.21859239,5 L13.5591854,5 Z M12.3333333,7.44444444 L7.44444444,7.44444444 L7.44444444,12.3333333 L12.3333333,12.3333333 L12.3333333,7.44444444 Z M5,18.4408146 C5,17.7678046 5.5466473,17.2222222 6.21859239,17.2222222 L13.5591854,17.2222222 C14.2321954,17.2222222 14.7777778,17.7688695 14.7777778,18.4408146 L14.7777778,25.7814076 C14.7777778,26.4544176 14.2311305,27 13.5591854,27 L6.21859239,27 C5.5455824,27 5,26.4533527 5,25.7814076 L5,18.4408146 Z M7.44444444,19.6666667 L7.44444444,24.5555556 L12.3333333,24.5555556 L12.3333333,19.6666667 L7.44444444,19.6666667 Z M17.2222222,18.4408146 C17.2222222,17.7678046 17.7688695,17.2222222 18.4408146,17.2222222 L25.7814076,17.2222222 C26.4544176,17.2222222 27,17.7688695 27,18.4408146 L27,25.7814076 C27,26.4544176 26.4533527,27 25.7814076,27 L18.4408146,27 C17.7678046,27 17.2222222,26.4533527 17.2222222,25.7814076 L17.2222222,18.4408146 Z M19.6666667,19.6666667 L19.6666667,24.5555556 L24.5555556,24.5555556 L24.5555556,19.6666667 L19.6666667,19.6666667 Z"/>
                        </svg>
                    </span>
                </a>
                @foreach ($categories as $item)
                    <a href="{{ route('homepage', ['category' => $item->slug ]) }}#rezultati" class="category-grid__item {{ $item->slug }} @if (old('category', $category) == $item->slug) category-grid__item--highlighted @endif">
                        <span>{{ $item->name }}</span>
                        <span class="category-grid__icon">
                            {!! $item->image_contents !!}
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

        <section>
            <a id="rezultati"></a>
            <h2 class="heading-line">Najnovije objave</h2>
            @foreach($posts as $post)
                <x-post :post="$post"/>
            @endforeach
        </section>

        {{ $posts->fragment('rezultati')->links() }}
    </div>

    <script type="text/javascript">
        ALGOLIA_APP_ID = `<?php echo env('ALGOLIA_APP_ID', '') ?>`;
        ALGOLIA_PUBLIC_SECRET = `<?php echo env('ALGOLIA_PUBLIC_SECRET', '') ?>`;
    </script>
@endsection

