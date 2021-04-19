{{ partial('macros/course') }}

{% if pager.total_pages > 0 %}
    <div class="review-list">
        {% for item in pager.items %}
            {% set owner_url = url({'for':'home.user.show','id':item.owner.id}) %}
            {% set like_url = url({'for':'home.review.like','id':item.id}) %}
            <div class="comment-card review-card clearfix">
                <div class="avatar">
                    <a href="{{ owner_url }}" title="{{ item.owner.name }}" target="_blank">
                        <img src="{{ item.owner.avatar }}!avatar_160" alt="{{ item.owner.name }}">
                    </a>
                </div>
                <div class="info">
                    <div class="rating">{{ star_info(item.rating) }}</div>
                    <div class="user">
                        <a href="{{ owner_url }}" target="_blank">{{ item.owner.name }}</a>
                    </div>
                    <div class="content">{{ item.content }}</div>
                    <div class="footer">
                        <div class="left">
                            <div class="column">
                                <span class="time" title="{{ date('Y-m-d H:i:s',item.create_time) }}">{{ item.create_time|time_ago }}</span>
                            </div>
                            <div class="column">
                                <span class="like-count" data-count="{{ item.like_count }}">{{ item.like_count }}</span>
                                {% if item.me.liked == 1 %}
                                    <span class="action action-like liked" title="取消点赞" data-url="{{ like_url }}">已赞</span>
                                {% else %}
                                    <span class="action action-like" title="点赞支持" data-url="{{ like_url }}">点赞</span>
                                {% endif %}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    {{ partial('partials/pager_ajax') }}
{% endif %}