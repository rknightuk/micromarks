@extends('template')

@section('content')

    <div class="header">
        <h1><img src="/assets/bookmark.svg">Micromarks</h1>
        <p>Manage your <a href="https://micro.blog">Micro.blog</a> bookmarks.</p>
    </div>
    <div class="details">
        <div>
            <img class="avatar" src="{{session()->get('mb_user')['photo']}}">
        </div>
        <div>
            <p>Signed in as {{ session()->get('mb_user')['name'] }} <a href="/logout">Sign Out</a><br>
                <a href="{{ session()->get('mb_user')['url'] }}">{{ session()->get('mb_user')['url'] }}</a></p>
        </div>
    </div>

    <div class="actions">
        <input type="text" placeholder="search bookmarks" class="search" id="search">
        <button onclick="deleteSelected()">Delete Selected</button>
    </div>
    <div class="links" id="links">
        Loading links...
    </div>

    <script>
        loadLinks = () => {
            document.getElementById('links').innerHTML = 'Loading Links...'
            fetch(
                '/bookmarks',
                {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                },
            ).then(response => response.json())
                .then(data => renderLinks(data))
        }

        renderLinks = (links) => {
            document.getElementById('links').innerHTML = ''
            links.map(link => {
                renderLink(link)
            })

            document.querySelectorAll('.link__delete').forEach(item => {
                item.addEventListener('click', e => {
                    e.preventDefault()
                    const id = e.currentTarget.dataset.id
                    deleteLink(id)
                })
            })
        }

        deleteLink = (id) => {
            fetch(
                '/bookmarks/' + id,
                {
                    method: 'delete',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                },
            ).then(response => removeLink(id))
        }

        removeLink = (id) => {
            Array.from(document.getElementsByClassName('link')).forEach(el => {
                if (el.dataset.id === id) el.remove()
            })
        }

        deleteSelected = () => {
            const checked = Array.from(document.querySelectorAll('input[type=checkbox]:checked'))
            checked.forEach(c => {
                const link = c.parentElement.parentElement
                const id = link.dataset.id
                console.log(id)
                if (!link.className.includes('hidden')) deleteLink(id)
            })
        }

        renderLink = (link) => {
            const el = document.getElementById("link__template").cloneNode(true)
            el.id = null
            el.dataset.id = link.id
            let content = link.content_html
            const contentEl = document.createElement('span')
            contentEl.innerHTML = content
            const sourceLink = Array.from(contentEl.getElementsByTagName('a')).slice(-1)[0]
            if (sourceLink) sourceLink.remove()
            el.getElementsByClassName('link__title')[0].append(contentEl)
            sourceLink.title = sourceLink.href
            const a = el.getElementsByClassName('link__link')[0].append(sourceLink)
            el.getElementsByClassName('link__saved')[0].innerText = formatDate(new Date(link._microblog.date_favorited))
            el.getElementsByClassName('link__delete')[0].dataset.id = link.id

            document.getElementById('links').appendChild(el)
        }

        formatDate = (date) => {
            return ("0" + date.getDate()).slice(-2) + "-" + ("0"+(date.getMonth()+1)).slice(-2) + "-" +
                date.getFullYear() + " " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2)
        }

        loadLinks()

        document.getElementById('search').addEventListener('keyup', (e) => {
            const query = e.currentTarget.value.toLowerCase()
            Array.from(document.getElementsByClassName('link')).forEach(el => {
                el.className = el.className.replace('hidden', '')
                if (
                    !el.getElementsByClassName('link__title')[0].innerText.toLowerCase().includes(query) &&
                    !el.getElementsByClassName('link__link')[0].innerText.toLowerCase().includes(query)
                ) {
                    el.className += ' hidden'
                }
            })
        })
    </script>

    <div class="link" id="link__template" data-id="0">
        <div class="link__checkbox">
            <input type="checkbox">
        </div>
        <div>
            <div class="link__title"></div>
            <div class="link__link"></div>
            <div class="link__dates">Saved: <span class="link__saved"></span></div>
            <a class="link__delete" href="#"><img src="/assets/delete.svg"></a>
        </div>
    </div>

@stop
