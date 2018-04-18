CREATE TABLE `videos` (
  `id` int(10) DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
);

INSERT INTO `videos` (`id`, `video_url`) VALUES
(0, ' //cdn6.limited/thetester/tester-step1.mp4'),
(1, '//cdn6.limited/thetester/tester-step1.mp4'),
(2, ' //cdn3.limited.com/unlimitedsystem/communication.mp4'),
(3, '//cdn3.limited/complex/path/of/more/folders/unlimitedsystem/communication.mp4'),
(4, '//cdn3.limited/complex/path/of/more/folders/unlimitedsystem/file.name.else.mp3');


-- I'm not sure about the schema, so I assumed the following about the video_url format:
-- - it starts with (optional) spaces, and a double slash
-- - the host name is the part that follows, up to the the third slash
-- - the filename (with extension) is everything after the last slash
-- - the extension of the filename is everything after the last dot of the filename
-- - everything between the host name and the filename is part of the path
-- - ALSO YOU CAN  USE LINK FROM SQLFIDDLE : http://sqlfiddle.com/#!9/d5772/2

select 
*,
-- find the third slash (after the two leading slashes), trim leading spaces, then trim leading slashes
trim("/" from ltrim(substring_index(video_url, '/', 3))) as host,

-- substring of the video url from after the third slash to 
-- right before the last slash
substr(video_url 
       from length(substring_index(video_url, '/', 3))+2
       for length(video_url) - length(substring_index(video_url, '/', -1)) - length(substring_index(video_url, '/', 3)) -2
       ) as path,

-- filename is from the last slash to before the last dot of the filename
left(substring_index(video_url, '/', -1), length(substring_index(video_url, '/', -1)) - length(substring_index(substring_index(video_url, '/', -1), '.', -1)) - 1) as video_name,

-- extension is after the last dot of the filename
substring_index(substring_index(video_url, '/', -1), '.', -1) as extension
from videos