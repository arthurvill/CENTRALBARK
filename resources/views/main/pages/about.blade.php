@extends('layouts.main.app')

@section('title', "$app_name | About Us")

@section('styles')
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        /* About Section */
        .about-section {
            padding: 3rem 2rem;
            /* background: linear-gradient(135deg, #ffffff, #f1f5f9);
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1); */
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }
        .about-section h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #023e8a ;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }
        .about-section .content {
            display: flex;
            align-items: center;
            gap: 2rem;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .about-section .content .text {
            flex: 1;
            font-size: 1rem;
            line-height: 1.8;
            color: #555;
            padding: 1rem;
        }
        .about-section .content .text p {
            margin-bottom: 1rem;
            text-align: justify;
        }
        .about-section .content .image-container {
            flex: 1;
            text-align: center;
            max-width: 450px;
            margin-top: 1rem;
        }
        .about-section .content .image-container img {
            width: 100%;
            height: auto;
            max-width: none;
            border-radius: 12px;
            /* box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .about-section .content .image-container img:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        /* Team Section */
        .team-title {
            text-align: center;
            margin-top: 4rem;
        }
        .team-title h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #023e8a ;
            margin-bottom: 0.8rem;
        }
        .team-title p {
            font-size: 1rem;
            color: #777;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Team Member Grid */
        .team-members {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Grid for responsiveness */
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Team Member Card */
        .team-member {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 1.5rem;
            text-align: center;
        }
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .team-member img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            max-height: 220px;
            margin-bottom: 1rem;
        }

        .team-member h3 {
            font-size: 1.4rem;
            font-weight: bold;
            color: #3490dc;
            margin-bottom: 0.5rem;
        }

        .team-member p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-members {
                grid-template-columns: 1fr 1fr; /* 2 items per row on medium screens */
            }
        }

    </style>
@endsection

@section('content')
    <div class="container pb-5">
        <!-- About Section -->
        <div class="about-section">
            <h1>About Us</h1>
            <div class="content">
                <!-- Text Section -->
                <div class="text">
                    <p>
                        Welcome to Central Bark Clinic, the leading provider of compassionate and professional veterinary care in Tungkop, Minglanilla, Cebu. We are dedicated to nurturing the bond between pets and their families through exceptional services tailored to your furry companions' unique needs.
                    </p>
                    <p>
                        Our team of experienced veterinarians and pet specialists is committed to delivering personalized care, ensuring the health and happiness of your pets. Whether it's wellness consultations, advanced treatments, or expert advice, Central Bark Clinic is here to help your pets thrive.
                    </p>
                </div>
                <!-- Image Section -->
                <div class="image-container">
                    <img src="{{ asset('img/about/about.png') }}" alt="About Us">
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="team-title">
            <h1>Our Team</h1>
            <p>Meet the experts dedicated to caring for your beloved pets.</p>
        </div>
        <div class="team-members">
            <!-- Team Member 1 -->
            <div class="team-member">
                <img src="{{ asset('img/team/t1.jpg') }}" alt="Expert 1">
                <h3>Jeniphyr M. Largo</h3>
                <p>Jeniphyr is a seasoned veterinary professional with over 10 years of experience. Her expertise lies in small animal medicine, and she is passionate about educating pet owners on maintaining their pets' health.</p>
            </div>

            <!-- Team Member 2 -->
            <div class="team-member">
                <img src="{{ asset('img/team/t2.jpg') }}" alt="Expert 2">
                <h3>Sin Causing</h3>
                <p>Sin is a skilled pet behavior specialist with a deep understanding of animal psychology. He works closely with pet owners to train and rehabilitate pets, ensuring a harmonious relationship between them.</p>
            </div>

            <!-- Team Member 3 -->
            <div class="team-member">
                <img src="{{ asset('img/team/t3.jpg') }}" alt="Expert 3">
                <h3>Camly Galingan</h3>
                <p>Camly is an expert in pet nutrition and wellness, helping owners select the best diets and supplements for their furry friends. She is dedicated to ensuring every pet lives a happy, healthy life.</p>
            </div>
        </div>
    </div>
@endsection
