<x-front.front>
    <x-slot name="header">
        <x-front.home.slider :slider="$slider"></x-front.home.slider>
    </x-slot>
    <x-front.home.about></x-front.home.about>
    <x-front.home.services :services="$services"></x-front.home.services>
    <x-front.home.clients :clients="$clients"></x-front.home.clients>
    <x-front.home.blog :blog="$blog"></x-front.home.blog>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
