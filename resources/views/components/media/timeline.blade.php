@props(['timelineData'])

<div class="namidia-timeline">
    @forelse($timelineData as $year => $months)
        <div class="namidia-timeline-year-group">
            <!-- Ponto do Ano na Timeline -->
            <div class="namidia-timeline-year">
                {{ $year }}
            </div>

            <!-- Loop de Meses -->
            @foreach($months as $month => $articles)
                <div class="timeline-month-group">
                    <h5 class="namidia-timeline-month">
                        {{ $month }}
                    </h5>
                    
                    <!-- Loop de Artigos do Mês -->
                    <ul class="namidia-timeline-list">
                        @foreach($articles as $article)
                            <li class="namidia-timeline-item">
                                <a href="{{ route('na-midia.show', $article->slug) }}" class="namidia-timeline-link">
                                    {{ $article->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @empty
        <p class="namidia-timeline-empty">Nenhuma publicação recente registrada.</p>
    @endforelse
</div>
