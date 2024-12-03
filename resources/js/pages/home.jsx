import { BentoCard } from '@/components/bento-card.jsx'
import { Container } from '@/components/container.jsx'
import Features from '@/components/features.jsx'
import Hero from '@/components/hero.jsx'
import { Keyboard } from '@/components/keyboard.jsx'
import { LinkedAvatars } from '@/components/linked-avatars.jsx'
import { LogoCloud } from '@/components/logo-cloud.jsx'
import { LogoCluster } from '@/components/logo-cluster.jsx'
import { LogoTimeline } from '@/components/logo-timeline.jsx'
import { Map } from '@/components/map.jsx'
import { Heading, Subheading } from '@/components/text.jsx'

function BentoSection() {
  return (
    <Container>
      <Subheading>Workflow</Subheading>
      <Heading as='h3' className='mt-2 max-w-3xl'>
        Configure your authentication once. It just works.
      </Heading>

      <div className='mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-6 lg:grid-rows-2'>
        <BentoCard
          eyebrow='Insight'
          title='Get perfect clarity'
          description='Radiant uses social engineering to build a detailed financial picture of your leads. Know their budget, compensation package, social security number, and more.'
          graphic={
            <div className='h-80 bg-[url(/screenshots/profile.png)] bg-[size:1000px_560px] bg-[left_-109px_top_-112px] bg-no-repeat' />
          }
          fade={['bottom']}
          className='max-lg:rounded-t-4xl lg:col-span-3 lg:rounded-tl-4xl'
        />
        <BentoCard
          eyebrow='Analysis'
          title='Undercut your competitors'
          description='With our advanced data mining, you’ll know which companies your leads are talking to and exactly how much they’re being charged.'
          graphic={
            <div className='absolute inset-0 bg-[url(/screenshots/competitors.png)] bg-[size:1100px_650px] bg-[left_-38px_top_-73px] bg-no-repeat' />
          }
          fade={['bottom']}
          className='lg:col-span-3 lg:rounded-tr-4xl'
        />
        <BentoCard
          eyebrow='Speed'
          title='Built for power users'
          description='It’s never been faster to cold email your entire contact list using our streamlined keyboard shortcuts.'
          graphic={
            <div className='flex size-full pl-10 pt-10'>
              <Keyboard highlighted={['LeftCommand', 'LeftShift', 'D']} />
            </div>
          }
          className='lg:col-span-2 lg:rounded-bl-4xl'
        />
        <BentoCard
          eyebrow='Source'
          title='Get the furthest reach'
          description='Bypass those inconvenient privacy laws to source leads from the most unexpected places.'
          graphic={<LogoCluster />}
          className='lg:col-span-2'
        />
        <BentoCard
          eyebrow='Limitless'
          title='Sell globally'
          description='Radiant helps you sell in locations currently under international embargo.'
          graphic={<Map />}
          className='max-lg:rounded-b-4xl lg:col-span-2 lg:rounded-br-4xl'
        />
      </div>
    </Container>
  )
}

function DarkBentoSection() {
  return (
    <div className='mx-2 mt-2 rounded-4xl bg-gray-900 py-32'>
      <Container>
        <Subheading dark>Outreach</Subheading>
        <Heading as='h3' dark className='mt-2 max-w-3xl'>
          Customer outreach has never been easier.
        </Heading>

        <div className='mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-6 lg:grid-rows-2'>
          <BentoCard
            dark
            eyebrow='Networking'
            title='Sell at the speed of light'
            description="Our RadiantAI chat assistants analyze the sentiment of your conversations in real time, ensuring you're always one step ahead."
            graphic={<div className='h-80 bg-[url(/screenshots/networking.png)] bg-[size:851px_344px] bg-no-repeat' />}
            fade={['top']}
            className='max-lg:rounded-t-4xl lg:col-span-4 lg:rounded-tl-4xl'
          />
          <BentoCard
            dark
            eyebrow='Integrations'
            title='Meet leads where they are'
            description='With thousands of integrations, no one will be able to escape your cold outreach.'
            graphic={<LogoTimeline />}
            // `!overflow-visible` is needed to work around a Chrome bug that disables the mask on the graphic.
            className='z-10 !overflow-visible lg:col-span-2 lg:rounded-tr-4xl'
          />
          <BentoCard
            dark
            eyebrow='Meetings'
            title='Smart call scheduling'
            description="Automatically insert intro calls into your leads' calendars without their consent."
            graphic={<LinkedAvatars />}
            className='lg:col-span-2 lg:rounded-bl-4xl'
          />
          <BentoCard
            dark
            eyebrow='Engagement'
            title='Become a thought leader'
            description='RadiantAI automatically writes LinkedIn posts that relate current events to B2B sales, helping you build a reputation as a thought leader.'
            graphic={<div className='h-80 bg-[url(/screenshots/engagement.png)] bg-[size:851px_344px] bg-no-repeat' />}
            fade={['top']}
            className='max-lg:rounded-b-4xl lg:col-span-4 lg:rounded-br-4xl'
          />
        </div>
      </Container>
    </div>
  )
}

export default function Home() {
  return (
    <div className='overflow-hidden'>
      <Hero />
      <main>
        <Container className='mt-10'>
          <LogoCloud />
        </Container>
        <div className='bg-gradient-to-b from-white from-50% to-gray-100 py-32'>
          <Features />
          <BentoSection />
        </div>
        <DarkBentoSection />

        {/*  <HowItWorks />*/}
        {/*  <Pricing />*/}
        {/*  <Testimonials />*/}
        {/*  <FAQ />*/}
        {/*  <CTA />*/}
      </main>
    </div>
  )
}
