<nav class="navbar navbar-default navbar-lg mtm" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-02">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="{{ route('survey.index') }}">These</a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-02">
        <ul class="nav navbar-nav">
            <li class="{{ setActive('results.index') }}">
                <a href="{!! route('results.index') !!}">
                    <span class="fui-bookmark"></span> &nbsp;Bilan
                </a>
            </li>
            <li class="{{ setActive('results.listAllAnswers') }}">
                <a href="{!! route('results.listAllAnswers') !!}">
                    <span class="fui-list-numbered"> </span> &nbsp;Liste des réponses
                </a>
            </li>
            <li class="{{ setActive('results.listAllExploded') }}">
                <a href="{!! route('results.listAllExploded') !!}">
                <i class="fa fa-bomb"></i> &nbsp;Liste Explosée
                </a>
            </li>
            <li class="{{ setActive('results.analyse') }}">
                <a href="{!! route('results.analyse') !!}">
                    <span class="fui-loop"> </span> &nbsp;Analyse
                </a>
            </li>
            @if(Auth::user()->isAdmin())
            <li class="{{ setActive('results.admin') }}">
                <a href="{!! route('results.admin') !!}">
                    <span class="fui-gear"> </span> &nbsp;Admin
                </a>
            </li>
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{!! route('logout') !!}"><span class="fui-power"></span>&nbsp; Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>
