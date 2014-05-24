local PLUGIN = PLUGIN;
local Clockwork = Clockwork;

-- Called each tick.
function PLUGIN:Tick()
	local curTime = CurTime();

	if (!nextAd or curTime > nextAd) then
 		local ADVERT = table.Random(Clockwork.advertisement.stored);

 		if (ADVERT) then
 			local advertInterval = Clockwork.config:Get("advert_interval"):Get();

 			Clockwork.hint:SendAll(ADVERT.text, ADVERT.delay, ADVERT.color);
 			nextAd = curTime + advertInterval;
 		end;
	end;

end;