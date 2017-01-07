<?php
use PHPUnit\Framework\TestCase;
use Blog\Manager;

class GeneralTest extends TestCase {

  public function config1() {
    return array(
      "posts" => array(
        "dir" => __DIR__ . "/posts",
        "perpage" => 5
      ),
      "pages" => array(
        "dir" => __DIR__ . "/pages/"
      ),
      "url" => "http://localhost:8000"
    );
  }

  public function test_get_page() {
    $config = $this->config1();
    $bm = new Manager($config);
    $page = $bm->get_page("test");
    $this->assertEquals($page->body, "<p>Test</p>");
    $this->assertEquals($page->title, "test");
    $this->assertEquals($page->url, $config["url"] . "/test");
  }
  public function test_get_post_names() {
    $config = $this->config1();
    $bm = new Manager($config);
    $posts_names = $bm->get_post_names();
    $this->assertGreaterThan(0, count($posts_names));
    $this->assertEquals($posts_names[0], $config["posts"]["dir"] . "/2017-01-09_test.md");
  }
  /**
   * @depends test_get_post_names
   */
  public function test_find_post() {
    $config = $this->config1();
    $bm = new Manager($config);
    $post = $bm->find_post("2017", "01", "test");
    $this->assertNotFalse($post);
    $this->assertEquals($post->body, "<p>Test</p>");
    $this->assertEquals($post->title, "test");

    $post = $bm->find_post("2017", "01", "test8");
    $this->assertFalse($post);

    $post = $bm->find_post("2017", "03", "test");
    $this->assertFalse($post);

    $post = $bm->find_post("2016", "01", "test");
    $this->assertFalse($post);
  }
  /**
   * @depends test_get_post_names
   */
  public function test_get_posts() {
    $config = $this->config1();
    $bm = new Manager($config);
    $posts = $bm->get_posts();
    $this->assertEquals($posts[0]->body, "<p>Test</p>");
  }
  /**
   * @depends test_get_post_names
   */
  public function test_pagination() {
    $config = $this->config1();
    $bm = new Manager($config);
    $pagination = $bm->has_pagination();
    $this->assertFalse($pagination["prev"]);
    $this->assertFalse($pagination["next"]);
  }
  /**
   * @depends test_get_post_names
   */
  public function test_get_post_links() {
    $config = $this->config1();
    $bm = new Manager($config);
    $posts_links = $bm->get_post_links();
    $this->assertEquals($posts_links[0]->url, $config["url"] . "/2017/01/test");
  }

}
 ?>
