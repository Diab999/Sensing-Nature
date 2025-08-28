@extends('layouts.app')

@section('content')
<section class="page-section bg-light" id="team" style="padding-top: 2rem; padding-bottom: 2rem;">
    <div class="container px-4 px-lg-5">
        <div class="text-center">
            <h2 class="text-center mt-0">{{ __('messages.team') }}</h2>
            <hr class="divider" />
            <p class="text-muted mb-5">{{ __('messages.meet_the_team') }}</p>
        </div>
        
        <div class="row justify-content-center g-4" lang="{{ app()->getLocale() }}">
            @if($teamMembers->count() > 0)
                @foreach($teamMembers as $member)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="team-member-card" lang="{{ app()->getLocale() }}">
                            <div class="member-image-container">
                                @if($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}" 
                                         alt="{{ $member->getTranslation('name', app()->getLocale()) }}" 
                                         class="member-image">
                                @else
                                    <div class="member-placeholder">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="member-info">
                                <h5 class="member-role">
                                    @if(app()->getLocale() === 'ar')
                                        {!! str_replace(['(Full Stack)', '(Data Science)', '(Cybersecurity)', '(Agile)'], 
                                            ['<span class="english-term">(Full Stack)</span>', 
                                             '<span class="english-term">(Data Science)</span>', 
                                             '<span class="english-term">(Cybersecurity)</span>', 
                                             '<span class="english-term">(Agile)</span>'], 
                                            $member->getTranslation('role', app()->getLocale())) !!}
                                    @else
                                        {{ $member->getTranslation('role', app()->getLocale()) }}
                                    @endif
                                </h5>
                                <h4 class="member-name">{{ $member->getTranslation('name', app()->getLocale()) }}</h4>
                                <p class="member-bio">
                                    @if(app()->getLocale() === 'ar')
                                        {!! str_replace(['JavaScript', 'React', 'Node.js', 'Python', 'TensorFlow', 'CISSP', 'CEH', 'Scrum', 'Fortune 50'], 
                                            ['<span class="english-term">JavaScript</span>', 
                                             '<span class="english-term">React</span>', 
                                             '<span class="english-term">Node.js</span>', 
                                             '<span class="english-term">Python</span>', 
                                             '<span class="english-term">TensorFlow</span>', 
                                             '<span class="english-term">CISSP</span>', 
                                             '<span class="english-term">CEH</span>', 
                                             '<span class="english-term">Scrum</span>', 
                                             '<span class="english-term">Fortune 50</span>'], 
                                            $member->getTranslation('bio', app()->getLocale())) !!}
                                    @else
                                        {{ $member->getTranslation('bio', app()->getLocale()) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="empty-state">
                        <i class="bi bi-people text-muted" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                        <h4 class="text-muted mb-3">{{ __('messages.no_team_title') }}</h4>
                        <p class="text-muted mb-4">{{ __('messages.no_team_message') }}</p>
                        <a href="/{{ app()->getLocale() }}" class="btn btn-primary">{{ __('messages.back_to_home') }}</a>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $teamMembers->links() }}
        </div>
    </div>
</section>

<style>
.team-member-card {
    width: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    border: 1px solid rgba(244, 98, 58, 0.1);
    position: relative;
    overflow: hidden;
    height: 100%;
}

.team-member-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #f4623a, #c34e2e);
}

.team-member-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(244, 98, 58, 0.2);
    border-color: rgba(244, 98, 58, 0.3);
}

/* RTL Card Flow Implementation */
[lang="ar"] .row {
    flex-direction: row-reverse;
    direction: rtl;
}

/* Fix card order for Arabic layout - cards start from right */
[lang="ar"] .row .col-lg-4:nth-child(1) { order: 3; }
[lang="ar"] .row .col-lg-4:nth-child(2) { order: 2; }
[lang="ar"] .row .col-lg-4:nth-child(3) { order: 1; }
[lang="ar"] .row .col-lg-4:nth-child(4) { order: 6; }
[lang="ar"] .row .col-lg-4:nth-child(5) { order: 5; }
[lang="ar"] .row .col-lg-4:nth-child(6) { order: 4; }

/* Also handle medium screens */
[lang="ar"] .row .col-md-6:nth-child(1) { order: 2; }
[lang="ar"] .row .col-md-6:nth-child(2) { order: 1; }
[lang="ar"] .row .col-md-6:nth-child(3) { order: 4; }
[lang="ar"] .row .col-md-6:nth-child(4) { order: 3; }
[lang="ar"] .row .col-md-6:nth-child(5) { order: 6; }
[lang="ar"] .row .col-md-6:nth-child(6) { order: 5; }

/* Alternative approach - force RTL on the entire row container */
[lang="ar"] .row.justify-content-center {
    display: flex !important;
    flex-direction: row-reverse !important;
    direction: rtl !important;
}

/* Most specific override - target the exact container structure */
[lang="ar"] .container .row.justify-content-center.g-4 {
    display: flex !important;
    flex-direction: row-reverse !important;
    direction: rtl !important;
    justify-content: flex-end !important;
}

[lang="ar"] .team-member-card {
    text-align: right;
    direction: rtl;
}

[lang="ar"] .team-member-card .member-info {
    text-align: right;
    direction: rtl;
}

[lang="ar"] .team-member-card h5,
[lang="ar"] .team-member-card p {
    text-align: right;
    direction: rtl;
}

/* Center role and name on Arabic cards */
[lang="ar"] .team-member-card .member-role,
[lang="ar"] .team-member-card .member-name {
    text-align: center !important;
    margin-left: auto;
    margin-right: auto;
}

/* Isolate English terms in Arabic cards */
[lang="ar"] .team-member-card .english-term {
    direction: ltr;
    text-align: left;
    unicode-bidi: isolate;
    display: inline-block;
}

/* RTL Card Image Positioning - Fixed centering */
[lang="ar"] .team-member-card .member-image-container {
    margin: 0 auto 1.5rem !important;
    text-align: center;
}

/* Ensure images are centered in both LTR and RTL */
.member-image-container {
    width: 160px;
    height: 160px;
    margin: 0 auto 1.5rem;
    position: relative;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.member-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(244, 98, 58, 0.2);
    transition: transform 0.3s ease;
    display: block;
    margin: 0 auto;
}

.member-image:hover {
    transform: scale(1.05);
}

.member-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #f4623a, #c34e2e);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(244, 98, 58, 0.2);
}

.member-placeholder i {
    font-size: 3rem;
    color: #fff;
}

.member-info {
    text-align: center;
}

.member-role {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.member-name {
    color: #212529;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.member-bio {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    min-height: 4.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .team-member-card {
        padding: 1.5rem;
    }
    
    .member-image-container {
        width: 140px;
        height: 140px;
    }
    
    .member-name {
        font-size: 1.1rem;
    }
    
    .member-bio {
        font-size: 0.9rem;
        min-height: 4rem;
    }
}

@media (max-width: 576px) {
    .team-member-card {
        padding: 1.25rem;
    }
    
    .member-image-container {
        width: 120px;
        height: 120px;
    }
    
    .member-name {
        font-size: 1rem;
    }
    
    .member-bio {
        font-size: 0.85rem;
        min-height: 3.5rem;
    }
}

/* RTL Card Border and Shadow */
[lang="ar"] .team-member-card {
    border-radius: 15px 15px 15px 15px;
}

/* Empty state styling */
.empty-state {
    padding: 3rem 1rem;
    background: #f8f9fa;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

.empty-state i {
    color: #6c757d;
    opacity: 0.6;
}

.empty-state h4 {
    color: #495057;
    font-weight: 500;
}

.empty-state p {
    color: #6c757d;
    font-size: 1.1rem;
    line-height: 1.6;
}

.empty-state .btn {
    padding: 0.75rem 2rem;
    font-weight: 500;
    border-radius: 0.5rem;
}
</style>
@endsection 