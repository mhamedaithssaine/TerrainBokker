@extends('layouts.appHome')

@section('title', 'Contact')

@section('content')
    <section id="contact" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            @if (session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-3xl font-bold text-center mb-8 text-secondary">Contactez-nous</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nom</span>
                                </label>
                                <input type="text" name="name" placeholder="Votre nom" class="input input-bordered border-primary" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" name="email" placeholder="votre.email@exemple.com" class="input input-bordered border-primary" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Message</span>
                                </label>
                                <textarea name="message" class="textarea textarea-bordered border-primary h-24" placeholder="Votre message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-control mt-6">
                                <button type="submit" class="btn bg-primary text-white border-none hover:bg-secondary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4 text-primary">Informations de contact</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="text-primary text-xl mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p>123 Avenue du Sport, 75001 Paris, France</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-primary text-xl mr-4">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p>+212-7-72-09-09-70</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-primary text-xl mr-4">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p>mhamedaithssaine1@gmail.com</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-primary text-xl mr-4">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <p>Lun-Ven: 9h-20h | Sam-Dim: 10h-18h</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div class="flex space-x-4">
                                <a href="#" class="btn btn-circle btn-outline border-primary text-primary hover:bg-primary hover:text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-circle btn-outline border-primary text-primary hover:bg-primary hover:text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-circle btn-outline border-primary text-primary hover:bg-primary hover:text-white">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection